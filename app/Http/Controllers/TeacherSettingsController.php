<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TeacherSettingsController extends Controller
{
      // profile page (read-only) and the change-password form
    public function index()
    {
        return view('teacher.settings', ['user' => Auth::user()]);
    }

    public function password(Request $request)
    {
        // current_password checks the typed password against the saved one
        // confirmed expects a second field called password_confirmation
        $request->validate([
            'current_password' => 'required|current_password',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        User::where('id', $user->id)->update([
            'password_hash' => Hash::make($request->password),
        ]);


        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'PASSWORD_CHANGED', 'Changed own password');

        return back()->with('success', 'Password changed.');
    }
}
