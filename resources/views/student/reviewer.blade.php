@extends('layouts.student')

@section('title', 'Reviewer Sets')

@section('content')
<!-- ============================================================ -->
<!-- 17 - REVIEWER PRACTICE SETS (RESPONSIVE: MOBILE & DESKTOP)   -->
<!-- ============================================================ -->

<!-- Top Dark Green Banner -->
<div class="bg-[#11422d] text-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm mb-6">
    <div class="flex items-center gap-2.5 mb-4 md:hidden">
        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-xs">
            <span class="text-[#11422d] font-black text-base">Q</span>
        </div>
        <span class="text-xs font-bold tracking-wider uppercase text-white">DWCC QUIZGUARD</span>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Reviewer</h1>
            <p class="text-xs sm:text-sm text-emerald-100/80 mt-1">Practice with teacher-made question banks anytime</p>
        </div>
        <div class="hidden sm:inline-flex bg-white/10 px-4 py-2 rounded-xl text-xs font-semibold text-emerald-200 border border-white/10">
            5 Reviewer Sets Available
        </div>
    </div>
</div>

<!-- Main Body -->
<div class="space-y-6">

    <!-- Search Box and Filter Pills Row -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" 
                   placeholder="Search reviewer sets by topic or professor..." 
                   class="w-full bg-white text-xs sm:text-sm text-slate-700 pl-10 pr-4 py-3 rounded-2xl border border-slate-200/80 focus:border-[#11422d] focus:outline-none transition shadow-xs placeholder-slate-400">
        </div>

        <!-- Filter Tags -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 sm:pb-0 text-xs font-semibold shrink-0">
            <button type="button" class="px-3.5 py-2.5 rounded-xl bg-[#11422d] text-white shadow-xs">All</button>
            <button type="button" class="px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-slate-900 transition">Database</button>
            <button type="button" class="px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-slate-900 transition">Networking</button>
            <button type="button" class="px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-slate-900 transition">Programming</button>
        </div>
    </div>

    <!-- Reviewer Sets: 1 Column on Mobile, 2 or 3 Columns on Tablet/Desktop -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

        <!-- Set 1: Database Normalization -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start gap-3.5 mb-4">
                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-sm font-bold text-slate-900 leading-snug">Database Normalization</h2>
                    <p class="text-xs text-slate-500 mt-0.5">25 questions</p>
                    <p class="text-[11px] text-emerald-800 font-semibold mt-0.5">by Prof. Reyes</p>
                </div>
            </div>
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">1NF, 2NF, 3NF & BCNF</span>
                <button type="button" class="px-4 py-2 rounded-xl bg-[#11422d] hover:bg-[#0d3423] text-white text-xs font-semibold transition shadow-xs">
                    Practice
                </button>
            </div>
        </div>

        <!-- Set 2: SQL Basics -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start gap-3.5 mb-4">
                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-sm font-bold text-slate-900 leading-snug">SQL Basics</h2>
                    <p class="text-xs text-slate-500 mt-0.5">30 questions</p>
                    <p class="text-[11px] text-emerald-800 font-semibold mt-0.5">by Prof. Reyes</p>
                </div>
            </div>
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">SELECT, JOIN, GROUP BY</span>
                <button type="button" class="px-4 py-2 rounded-xl bg-[#11422d] hover:bg-[#0d3423] text-white text-xs font-semibold transition shadow-xs">
                    Practice
                </button>
            </div>
        </div>

        <!-- Set 3: Network Protocols -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start gap-3.5 mb-4">
                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-sm font-bold text-slate-900 leading-snug">Network Protocols</h2>
                    <p class="text-xs text-slate-500 mt-0.5">20 questions</p>
                    <p class="text-[11px] text-emerald-800 font-semibold mt-0.5">by Prof. Aquino</p>
                </div>
            </div>
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">TCP/IP, UDP, DNS, HTTP</span>
                <button type="button" class="px-4 py-2 rounded-xl bg-[#11422d] hover:bg-[#0d3423] text-white text-xs font-semibold transition shadow-xs">
                    Practice
                </button>
            </div>
        </div>

        <!-- Set 4: Systems Integration -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start gap-3.5 mb-4">
                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-sm font-bold text-slate-900 leading-snug">Systems Integration</h2>
                    <p class="text-xs text-slate-500 mt-0.5">18 questions</p>
                    <p class="text-[11px] text-emerald-800 font-semibold mt-0.5">by Prof. Reyes</p>
                </div>
            </div>
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">APIs, Webhooks, SOA</span>
                <button type="button" class="px-4 py-2 rounded-xl bg-[#11422d] hover:bg-[#0d3423] text-white text-xs font-semibold transition shadow-xs">
                    Practice
                </button>
            </div>
        </div>

        <!-- Set 5: Web Development Basics -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
            <div class="flex items-start gap-3.5 mb-4">
                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-sm font-bold text-slate-900 leading-snug">Web Development Basics</h2>
                    <p class="text-xs text-slate-500 mt-0.5">22 questions</p>
                    <p class="text-[11px] text-emerald-800 font-semibold mt-0.5">by Prof. Aquino</p>
                </div>
            </div>
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] text-slate-400">HTML5, CSS3, DOM APIs</span>
                <button type="button" class="px-4 py-2 rounded-xl bg-[#11422d] hover:bg-[#0d3423] text-white text-xs font-semibold transition shadow-xs">
                    Practice
                </button>
            </div>
        </div>

    </div>

</div>
@endsection
