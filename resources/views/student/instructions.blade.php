@extends('layouts.student')

@section('title', 'Quiz Rules & Instructions')

@section('content')
<!-- ============================================================ -->
<!-- 04 - QUIZ INSTRUCTIONS (RESPONSIVE: MOBILE & DESKTOP)         -->
<!-- ============================================================ -->

<!-- Top Dark Green Banner -->
<div class="bg-[#11422d] text-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm mb-6">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-xs">
                <span class="text-[#11422d] font-black text-base">Q</span>
            </div>
            <span class="text-xs font-bold tracking-wider uppercase text-white">DWCC QUIZGUARD</span>
        </div>

        <!-- Back to Quizzes link -->
        <a href="{{ route('student.quizzes') }}" class="text-xs text-emerald-200 hover:text-white transition flex items-center gap-1 font-medium">
            <span>←</span> Back to Quizzes
        </a>
    </div>

    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Advance Database</h1>
        <p class="text-xs sm:text-sm text-emerald-100/80 mt-1">Read the rules and requirements before you start</p>
    </div>
</div>

<!-- Main Body: 2 Columns on Desktop, 1 Column on Mobile -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

    <!-- LEFT COLUMN: Quiz Metrics & Anti-Cheat Rules (7 cols on desktop) -->
    <div class="lg:col-span-7 space-y-6">

        <!-- 1. Stats Grid Card (4 items in a 2x2 or 4x1 grid) -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900">20</p>
                <p class="text-xs font-semibold text-slate-500 mt-1">Questions</p>
            </div>
            <div>
                <p class="text-2xl sm:text-3xl font-black text-slate-900">25 <span class="text-base font-bold text-slate-600">min</span></p>
                <p class="text-xs font-semibold text-slate-500 mt-1">Time limit</p>
            </div>
            <div class="pt-2 sm:pt-0 border-t sm:border-t-0 sm:border-l border-slate-100 sm:pl-4">
                <p class="text-2xl sm:text-3xl font-black text-slate-900">1</p>
                <p class="text-xs font-semibold text-slate-500 mt-1">Attempt allowed</p>
            </div>
            <div class="pt-2 sm:pt-0 border-t sm:border-t-0 sm:border-l border-slate-100 sm:pl-4">
                <p class="text-2xl sm:text-3xl font-black text-[#11422d]">75%</p>
                <p class="text-xs font-semibold text-slate-500 mt-1">Passing score</p>
            </div>
        </div>

        <!-- 2. Anti-Cheat Rules Card -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center gap-2.5 text-slate-900 font-bold text-sm sm:text-base">
                <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <span>Anti-Cheat Proctoring Rules</span>
            </div>

            <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                <li class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-xs font-bold mt-0.5">⚠️</span>
                    <div>
                        <strong class="text-slate-900 block">Stay on the quiz screen</strong>
                        <span class="text-slate-500 text-xs">Do not click outside of the quiz interface or minimize the window.</span>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-xs font-bold mt-0.5">⚠️</span>
                    <div>
                        <strong class="text-slate-900 block">Do not switch tabs or windows</strong>
                        <span class="text-slate-500 text-xs">Switching to another browser tab will trigger an immediate violation notice.</span>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-xs font-bold mt-0.5">⚠️</span>
                    <div>
                        <strong class="text-slate-900 block">Keep full-screen mode on</strong>
                        <span class="text-slate-500 text-xs">Exiting full-screen mode is strictly monitored and flagged.</span>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-xs font-bold mt-0.5">⚠️</span>
                    <div>
                        <strong class="text-slate-900 block">Do not use other apps during the quiz</strong>
                        <span class="text-slate-500 text-xs">External application focus changes are logged to the proctor audit stream.</span>
                    </div>
                </li>
            </ul>

            <div class="pt-3 border-t border-slate-100 flex items-center gap-2 text-rose-700 bg-rose-50/60 p-3 rounded-xl border border-rose-200/50">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xs font-semibold">
                    Warning: After 3 violations, your quiz is submitted automatically.
                </p>
            </div>
        </div>

    </div>

    <!-- RIGHT COLUMN: Privacy Notice & Launch Button (5 cols on desktop) -->
    <div class="lg:col-span-5 space-y-6">

        <!-- 3. Data Privacy Notice Card -->
        <div class="bg-emerald-50/70 border border-emerald-200/70 p-6 rounded-2xl text-xs sm:text-sm text-emerald-950 space-y-2.5">
            <div class="flex items-center gap-2 font-bold text-emerald-900 text-sm">
                <svg class="w-5 h-5 text-emerald-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>Data Privacy Notice</span>
            </div>
            <p class="text-xs leading-relaxed text-emerald-900/90">
                Your quiz activity (start time, answers, submission, and any proctoring violations) is recorded and kept only for the school's retention period, in line with the <strong>Data Privacy Act of 2012 (RA 10173)</strong>.
            </p>
        </div>

        <!-- 4. Agreement Checkbox & Action Box -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-5">
            <label class="flex items-start gap-3 cursor-pointer select-none">
                <input type="checkbox" id="agreeCheckbox" checked class="w-5 h-5 mt-0.5 rounded text-[#11422d] focus:ring-emerald-600 border-slate-300">
                <div class="text-xs text-slate-800">
                    <span class="font-bold block text-sm text-slate-900">I understand and agree to be monitored</span>
                    <span class="text-slate-500">I agree to follow the examination code of conduct and anti-cheating guidelines.</span>
                </div>
            </label>

            <a href="{{ route('student.exam') }}" 
               class="w-full block py-4 px-6 bg-[#11422d] hover:bg-[#0d3423] text-white text-center font-bold text-sm sm:text-base rounded-2xl transition shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Start Quiz (Enter Full-Screen)</span>
            </a>

            <p class="text-[11px] text-center text-slate-400">
                Clicking will launch the exam in proctored full-screen mode.
            </p>
        </div>

    </div>

</div>
@endsection
