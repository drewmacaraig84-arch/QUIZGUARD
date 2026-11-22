@php $hideNav = true; @endphp
@extends('layouts.student')

@section('title', 'Quiz Auto-Submitted')

@section('content')
<!-- ============================================================ -->
<!-- 16 - QUIZ AUTO-SUBMITTED (RESPONSIVE: MOBILE & DESKTOP)       -->
<!-- ============================================================ -->

<div class="max-w-2xl mx-auto space-y-6">

    <!-- Top Dark Green Header -->
    <div class="bg-[#11422d] text-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-xs">
                <span class="text-[#11422d] font-black text-base">Q</span>
            </div>
            <span class="text-xs font-bold tracking-wider uppercase text-white">DWCC QUIZGUARD</span>
        </div>
        <span class="text-xs text-rose-300 font-semibold uppercase tracking-wider">Exam Terminated</span>
    </div>

    <!-- Main Alert Container -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6 text-center">

        <!-- Red Alert Icon -->
        <div class="w-16 h-16 rounded-full bg-rose-50 border-4 border-rose-100 text-rose-500 mx-auto flex items-center justify-center text-2xl font-bold shadow-xs">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <!-- Alert Title & Subtitle -->
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Quiz submitted automatically</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1.5 max-w-md mx-auto">
                You reached the limit of <strong>3 violations</strong>, so your quiz attempt was automatically submitted and locked by the proctoring engine.
            </p>
        </div>

        <!-- Two Columns on Tablet/Desktop for Details & Logs -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
            <!-- 1. Summary Details Card -->
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/70 text-xs divide-y divide-slate-200/60 flex flex-col justify-between">
                <div>
                    <h2 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2.5">Attempt Summary</h2>
                    <div class="py-2.5 flex items-center justify-between">
                        <span class="text-slate-500">Subject</span>
                        <span class="font-bold text-slate-800">Advance Database</span>
                    </div>
                    <div class="py-2.5 flex items-center justify-between">
                        <span class="text-slate-500">Questions answered</span>
                        <span class="font-bold text-slate-800">12 of 20</span>
                    </div>
                    <div class="py-2.5 flex items-center justify-between">
                        <span class="text-slate-500">Total Violations</span>
                        <span class="font-bold text-rose-600">3 of 3</span>
                    </div>
                </div>
                <div class="pt-2.5 flex items-center justify-between">
                    <span class="text-slate-500">Submitted at</span>
                    <span class="font-bold text-slate-800">7:31 AM</span>
                </div>
            </div>

            <!-- 2. Violation Log Audit Card -->
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/70 text-left space-y-2.5">
                <h2 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Violation log</h2>

                <div class="divide-y divide-slate-200/60 text-xs">
                    <!-- Violation 1 -->
                    <div class="py-2 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">7:24 AM</span>
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-100/70 text-rose-700 border border-rose-200">
                            Tab switching
                        </span>
                    </div>
                    <!-- Violation 2 -->
                    <div class="py-2 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">7:27 AM</span>
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-100/70 text-rose-700 border border-rose-200">
                            Exited full-screen
                        </span>
                    </div>
                    <!-- Violation 3 -->
                    <div class="py-2 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">7:31 AM</span>
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100/70 text-amber-800 border border-amber-200">
                            Window focus lost
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
            <a href="{{ route('student.profile') }}" 
               class="flex-1 py-3.5 bg-[#11422d] hover:bg-[#0d3423] text-white font-bold text-xs sm:text-sm rounded-xl transition shadow-xs">
                View Result & Profile
            </a>
            <a href="{{ route('student.quizzes') }}" 
               class="flex-1 py-3.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs sm:text-sm rounded-xl transition shadow-xs">
                Back to Quizzes
            </a>
        </div>

    </div>

</div>
@endsection
