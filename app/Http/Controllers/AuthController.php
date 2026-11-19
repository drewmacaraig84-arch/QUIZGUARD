<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // displays login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // login method
    public function login(Request $request)
    {
        //validates email and password and inserts them in the credentials array
        $credentials = $request->validate([
            'dwcc_email' => 'required|email',
            'password' => 'required',
        ]);

        // when above = to true, add in the array the status active
        $credentials['status'] = 'active';

        // attempting logging the user with the credentials
        if (Auth::attempt($credentials)) {
            // makes new session id when user logs in
            $request->session()->regenerate();

            ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'LOGIN', 'User logged in');

            // fetches the role of the user in the role variable
            $role = Auth::user()->role;

            // if role is admin redirect to admin dashboard
            if ($role === 'admin') {
                return redirect('/admin/dashboard');
            }
            // if role is teacher redirect to teacher dashboard
            elseif ($role === 'teacher') {
                return redirect('/teacher/dashboard');
            }

            // if role is student redirect to student dashboard
            return redirect('/student/dashboard');
        }
        // finding users according to dwcc email
        $user = User::where('dwcc_email', $request->dwcc_email)->first();
        // records failed login if no school id number takes the role if its also unknown fallback to null
        ActivityLog::record($user->school_id_num ?? null,$user->role ?? null,'LOGIN_FAILED','Wrong credentials for ' . $request->dwcc_email);
        // if validation returns false give error message
        // keep error message vague and general to not reveal if email or passwords exists in the db
        // withinput method keeps the typed email
        return back()->withErrors(['dwcc_email' => 'Wrong email or password.'])->withInput();
    }

    // logout method
    public function logout(Request $request)
    {
        if (Auth::check()) {
            ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'LOGOUT', 'User logged out');
        }
        // logout
        Auth::logout();

        // wipes data from the user session
        $request->session()->invalidate();

        // makes new token (cross site request forgery token) for the next user
        $request->session()->regenerateToken();

        // redirect to login page
        return redirect('/login');
    }
}
