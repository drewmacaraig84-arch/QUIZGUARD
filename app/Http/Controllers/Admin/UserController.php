<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // list of users optional filter by role
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('last_name')->paginate(20)->withQueryString();

        return view('admin.users', ['users' => $users]);
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

        // the admin can't lock himself out
        if ($user->user_id == Auth::id()) {
            return back()->withErrors(['user' => 'You cannot deactivate your own account.']);
        }

        $user->update(['status' => $user->status === 'active' ? 'inactive' : 'active']);

        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'USER_' . strtoupper($user->status), 'Set user ' . $user->school_id_num . ' to ' . $user->status);

        return redirect('/admin/users')->with('success', 'User is now ' . $user->status . '.');
    }
}
