<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // list of users optional filter by role
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role'))    $query->where('role', $request->role);
        if ($request->filled('section')) $query->where('section', $request->section);
        if ($request->filled('status'))  $query->where('status', $request->status);

        // search by name or email
        if ($request->filled('q')) {
            foreach (preg_split('/\s+/', trim($request->q)) as $word) {
                $query->where(function ($w) use ($word) {
                    $w->where('first_name', 'like', "%$word%")
                        ->orWhere('last_name', 'like', "%$word%")
                        ->orWhere('dwcc_email', 'like', "%$word%");
                });
            }
        }

        $users = $query->orderBy('last_name')->paginate(20)->withQueryString();

        // numbers for the All / Students / Teachers pills
        $counts = [
            'all'      => User::count(),
            'students' => User::where('role', 'student')->count(),
            'teachers' => User::where('role', 'teacher')->count(),
        ];
        $sections = User::whereNotNull('section')->distinct()->orderBy('section')->pluck('section');

        return view('admin.users', ['users' => $users, 'counts' => $counts, 'sections' => $sections]);
    }

    // creates a new account
    public function store(Request $request)
    {
        // unique: no two users can share a school id or an email
        $request->validate([
            'role'          => 'required|in:student,teacher,admin',
            'school_id_num' => 'required|integer|unique:users,school_id_num',
            'first_name'    => 'required|max:45',
            'middle_name'   => 'nullable|max:45',
            'last_name'     => 'required|max:45',
            'dwcc_email'    => 'required|email|max:45|unique:users,dwcc_email',
            'password'      => 'required|min:8',
            'department'    => 'required|max:45',
            'section'       => 'required_if:role,student|nullable|max:45',
        ]);

        $user = User::create([
            'role'          => $request->role,
            'school_id_num' => $request->school_id_num,
            'first_name'    => $request->first_name,
            'middle_name'   => $request->middle_name,
            'last_name'     => $request->last_name,
            'dwcc_email'    => $request->dwcc_email,
            'password_hash' => Hash::make($request->password),   // never store the plain password
            'department'    => $request->department,
            'section'       => $request->section,
            'status'        => 'pending',
        ]);

        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'USER_CREATED', 'Created ' . $user->role . ' account: ' . $user->school_id_num);

        try {
            $user->sendOtp();
        } catch (\Exception $e) {
            // the account exists even if the email failed; the user can request a new code
            return redirect('/admin/users')->with('success', 'User created, but the email could not be sent.');
        }

        return redirect('/admin/users')->with('success', 'User created. A verification code was sent to their email.');
    }

    // soft delete: switches between active and inactive (inactive users can't log in)
    public function toggle($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();

        // pending accounts can only be activated with their OTP
        if ($user->status === 'pending') {
            return back()->withErrors(['user' => 'This account must be activated with its OTP.']);
        }
        // the admin can't lock himself out
        if ($user->user_id == Auth::id()) {
            return back()->withErrors(['user' => 'You cannot deactivate your own account.']);
        }

        $user->update(['status' => $user->status === 'active' ? 'inactive' : 'active']);

        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'USER_' . strtoupper($user->status), 'Set user ' . $user->school_id_num . ' to ' . $user->status);

        return redirect('/admin/users')->with('success', 'User is now ' . $user->status . '.');
    }
    // imports many users from a CSV file (first line = column names)
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:csv,txt|max:2048']);

        set_time_limit(300);   // sending one email per user can take a while

        $handle = fopen($request->file('file')->getRealPath(), 'r');
        $header = fgetcsv($handle);

        if (!$header) {
            return back()->withErrors(['file' => 'The file is empty.']);
        }

        // Excel adds an invisible mark at the start of the file: remove it, then clean the names
        $header[0] = ltrim($header[0], "\xEF\xBB\xBF");
        $header = array_map(fn($h) => strtolower(trim($h)), $header);

        $created = 0;
        $errors  = [];
        $line    = 1;   // line 1 is the header

        while (($row = fgetcsv($handle)) !== false) {
            $line++;

            // skip completely empty lines
            if (count(array_filter($row, fn($v) => trim($v) !== '')) === 0) {
                continue;
            }

            // every line needs the same number of columns as the header
            if (count($row) !== count($header)) {
                $errors[] = "Line $line: wrong number of columns.";
                continue;
            }

            // pair each value with its column name
            $data = array_combine($header, array_map('trim', $row));

            // same rules as the Add User form
            $validator = Validator::make($data, [
                'role'          => 'required|in:student,teacher,admin',
                'school_id_num' => 'required|integer|unique:users,school_id_num',
                'first_name'    => 'required|max:45',
                'middle_name'   => 'nullable|max:45',
                'last_name'     => 'required|max:45',
                'dwcc_email'    => 'required|email|max:45|unique:users,dwcc_email',
                'password'      => 'required|min:8',
                'department'    => 'required|max:45',
                'section'       => 'required_if:role,student|nullable|max:45',
            ]);

            // a bad line is skipped and reported, the good lines are still imported
            if ($validator->fails()) {
                $errors[] = "Line $line: " . $validator->errors()->first();
                continue;
            }

            $user = User::create([
                'role'          => $data['role'],
                'school_id_num' => $data['school_id_num'],
                'first_name'    => $data['first_name'],
                'middle_name'   => $data['middle_name'] ?: null,
                'last_name'     => $data['last_name'],
                'dwcc_email'    => $data['dwcc_email'],
                'password_hash' => Hash::make($data['password']),
                'department'    => $data['department'],
                'section'       => $data['section'] ?: null,
                'status'        => 'pending',   // activated later with the OTP
            ]);

            try {
                $user->sendOtp();
            } catch (\Exception $e) {
                $errors[] = "Line $line: user created, but the email could not be sent.";
            }

            $created++;
        }

        fclose($handle);

        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'USERS_IMPORTED', "Imported $created users from CSV");

        // only the first 10 problems are shown, so the page stays readable
        return redirect('/admin/users')
            ->with('success', "$created users imported.")
            ->withErrors(array_slice($errors, 0, 10));
    }
}
