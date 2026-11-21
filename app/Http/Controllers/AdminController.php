<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the Admin Dashboard (System Health & Server Metrics).
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the User Management page (Students & Teachers).
     */
    public function users()
    {
        return view('admin.users');
    }

    /**
     * Show the Sections & Subjects management page.
     */
    public function sectionsSubjects()
    {
        return view('admin.sections-subjects');
    }

    /**
     * Show the System Audit Logs page.
     */
    public function logs()
    {
        return view('admin.logs');
    }
}

