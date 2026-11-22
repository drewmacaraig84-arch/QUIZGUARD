@extends('layouts.student')

@section('title', 'My Quizzes')

@section('content')
<!-- ============================================================ -->
<!-- 03 - MY QUIZZES (RESPONSIVE: MOBILE & DESKTOP)                -->
<!-- ============================================================ -->

<!-- Top Dark Green Banner -->
<div class="bg-[#11422d] text-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm mb-6">
    <!-- Mobile-only brand badge -->
    <div class="flex items-center gap-2.5 mb-4 md:hidden">
        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-xs">
            <span class="text-[#11422d] font-black text-base">Q</span>
        </div>
        <span class="text-xs font-bold tracking-wider uppercase text-white">DWCC QUIZGUARD</span>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">My Quizzes</h1>
            <p class="text-xs sm:text-sm text-emerald-100/80 mt-1">Take graded quizzes and track your attempts</p>
        </div>
        <div class="hidden sm:inline-flex bg-white/10 px-4 py-2 rounded-xl text-xs font-semibold text-emerald-200 border border-white/10">
            Term: 1st Semester 2026-2027
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="space-y-6">

    <!-- Segmented Tab Bar -->
    <div class="bg-white p-1 rounded-2xl border border-slate-200/80 shadow-xs flex items-center max-w-md text-xs font-medium">
        <button type="button" class="flex-1 py-2 text-center rounded-xl bg-[#11422d] text-white font-semibold shadow-xs transition">
            Available <span class="ml-1 opacity-90">3</span>
        </button>
        <button type="button" class="flex-1 py-2 text-center rounded-xl text-slate-600 hover:text-slate-900 transition">
            Upcoming <span class="ml-1 text-slate-400">1</span>
        </button>
        <button type="button" class="flex-1 py-2 text-center rounded-xl text-slate-600 hover:text-slate-900 transition">
            Completed <span class="ml-1 text-slate-400">3</span>
        </button>
    </div>

    <!-- Quiz Cards: 1 column on Mobile, 2 or 3 columns on Tablet/Desktop -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card 1: Advance Database -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div>
                <div class="flex items-start gap-3.5 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100/70 text-[#11422d] font-black text-sm flex items-center justify-center shrink-0">
                        DB
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-base font-bold text-slate-900 leading-snug">Advance Database</h2>
                        <p class="text-xs text-slate-500 mt-0.5">20 questions · 25 minutes</p>
                        <p class="text-[11px] text-slate-400">1 attempt allowed</p>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="text-[11px] font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                    Closes Nov 20, 5:00 PM
                </span>
                <a href="{{ route('student.instructions') }}" 
                   class="px-4 py-2 rounded-xl bg-[#11422d] hover:bg-[#0d3423] text-white text-xs font-semibold transition shadow-xs">
                    Start quiz
                </a>
            </div>
        </div>

        <!-- Card 2: Systems Integration -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div>
                <div class="flex items-start gap-3.5 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100/70 text-[#11422d] font-black text-sm flex items-center justify-center shrink-0">
                        SI
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-base font-bold text-slate-900 leading-snug">Systems Integration</h2>
                        <p class="text-xs text-slate-500 mt-0.5">30 questions · 40 minutes</p>
                        <p class="text-[11px] text-slate-400">1 attempt allowed</p>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="text-[11px] font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                    Closes Nov 25, 3:00 PM
                </span>
                <a href="{{ route('student.instructions') }}" 
                   class="px-4 py-2 rounded-xl bg-[#11422d] hover:bg-[#0d3423] text-white text-xs font-semibold transition shadow-xs">
                    Start quiz
                </a>
            </div>
        </div>

        <!-- Card 3: Web Development -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div>
                <div class="flex items-start gap-3.5 mb-3">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100/70 text-[#11422d] font-black text-sm flex items-center justify-center shrink-0">
                        WD
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="text-base font-bold text-slate-900 leading-snug">Web Development</h2>
                        <p class="text-xs text-slate-500 mt-0.5">25 questions · 30 minutes</p>
                        <p class="text-[11px] text-slate-400">2 attempts allowed</p>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-amber-800 bg-amber-50 border border-amber-200/60 px-3 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Closing soon: Nov 14, 11:59 PM
                </span>
                <a href="{{ route('student.instructions') }}" 
                   class="px-4 py-2 rounded-xl bg-[#11422d] hover:bg-[#0d3423] text-white text-xs font-semibold transition shadow-xs">
                    Start quiz
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
