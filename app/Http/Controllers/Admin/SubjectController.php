<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    // all subjects, including inactive ones so the admin can reactivate them
    public function index()
    {
        $subjects = Subject::orderBy('subject_code')->get();

        $sections = User::where('role', 'student')
            ->whereNotNull('section')
            ->selectRaw('section, COUNT(*) as total')   // how many students per section
            ->groupBy('section')
            ->orderBy('section')
            ->get();

        $stats = [
            'sections' => $sections->count(),
            'subjects' => $subjects->where('status', 'active')->count(),
            'students' => User::where('role', 'student')->count(),
            'teachers' => User::where('role', 'teacher')->count(),
        ];

        return view('admin.sections-subjects', [
            'subjects' => $subjects,
            'sections' => $sections,
            'stats'    => $stats,
        ]);
    }

    // creates a new subject
    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|max:45|unique:subjects,subject_code',
            'subject_name' => 'required|max:100',
        ]);

        $subject = Subject::create([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
            'status'       => 'active',
        ]);

        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'SUBJECT_CREATED', 'Created subject: ' . $subject->subject_code);

        return redirect('/admin/sections-subjects')->with('success', 'Subject added.');
    }

    // soft delete: switches between active and inactive
    public function toggle($id)
    {
        $subject = Subject::where('subject_id', $id)->firstOrFail();

        $subject->update(['status' => $subject->status === 'active' ? 'inactive' : 'active']);

        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'SUBJECT_' . strtoupper($subject->status), 'Set subject ' . $subject->subject_code . ' to ' . $subject->status);

        return redirect('/admin/sections-subjects')->with('success', 'Subject is now ' . $subject->status . '.');
    }
}
