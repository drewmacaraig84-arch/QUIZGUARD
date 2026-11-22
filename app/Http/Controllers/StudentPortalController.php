<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentPortalController extends Controller
{
    /**
     * Show the Student Quizzes page (My Quizzes).
     */
    public function quizzes()
    {
        return view('student.quizzes');
    }

    /**
     * Show the Quiz Instructions and Rules page before starting.
     */
    public function instructions()
    {
        return view('student.instructions');
    }

    /**
     * Show the Active Exam taking room with proctoring checks.
     */
    public function exam()
    {
        return view('student.exam');
    }

    /**
     * Show the Quiz Submitted / Disqualification screen.
     */
    public function submitted()
    {
        return view('student.submitted');
    }

    /**
     * Show the Reviewer / Practice Questions sets.
     */
    public function reviewer()
    {
        return view('student.reviewer');
    }

    /**
     * Show the Student Profile and Quiz History.
     */
    public function profile()
    {
        return view('student.profile');
    }
}

