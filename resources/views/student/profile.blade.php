@extends('layouts.student')

@section('title', 'Student Profile')

@section('content')
<!-- ============================================================ -->
<!-- 18 - PROFILE & HISTORY (RESPONSIVE: MOBILE & DESKTOP)        -->
<!-- ============================================================ -->

<!-- Top Dark Green Curved Banner -->
<div class="bg-[#11422d] text-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm mb-6">
    <div class="flex items-center gap-2.5 mb-4 md:hidden">
        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-xs">
            <span class="text-[#11422d] font-black text-base">Q</span>
        </div>
        <span class="text-xs font-bold tracking-wider uppercase text-white">DWCC QUIZGUARD</span>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Profile</h1>
            <p class="text-xs sm:text-sm text-emerald-100/80 mt-1">Your account and quiz performance history</p>
        </div>
        <!-- Quick stats on desktop -->
        <div class="hidden sm:flex items-center gap-4 bg-white/10 px-5 py-3 rounded-2xl border border-white/10 text-xs">
            <div class="text-center">
                <span class="text-lg font-bold text-white block">3</span>
                <span class="text-[10px] text-emerald-200">Quizzes Taken</span>
            </div>
            <div class="w-px h-8 bg-white/20"></div>
            <div class="text-center">
                <span class="text-lg font-bold text-emerald-300 block">67%</span>
                <span class="text-[10px] text-emerald-200">Pass Rate</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Body: 2-Column Grid on Desktop, Single Column on Mobile -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- LEFT COLUMN: Profile Info & Account Actions (1 col on desktop) -->
    <div class="lg:col-span-1 space-y-5">
        <!-- 1. Student Identity Card -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs text-center sm:text-left flex flex-col sm:flex-row lg:flex-col items-center sm:items-start lg:items-center gap-4">
            <!-- Large Avatar -->
            <div class="w-16 h-16 rounded-full bg-[#11422d] text-white font-extrabold text-xl flex items-center justify-center shrink-0 shadow-md ring-4 ring-emerald-50">
                SB
            </div>
            <div class="text-center sm:text-left lg:text-center min-w-0">
                <h2 class="text-base font-bold text-slate-900 leading-snug">Sayo Boy</h2>
                <p class="text-xs text-slate-500 font-medium mt-0.5">Student ID: 2023-0210</p>
                <p class="text-xs font-semibold text-emerald-800 mt-0.5">BSIT 3A</p>
                <p class="text-xs text-slate-400 mt-1 truncate">sayo.boy@dwcc.edu.ph</p>
            </div>
        </div>

        <!-- 2. Account Menu Options -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs divide-y divide-slate-100 overflow-hidden text-xs text-slate-700 font-medium">
            <a href="#" class="px-5 py-3.5 flex items-center justify-between hover:bg-slate-50 transition">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <span>Data Privacy Notice</span>
                </div>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
            </a>
            <a href="#" class="px-5 py-3.5 flex items-center justify-between hover:bg-slate-50 transition">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <span>Change Password</span>
                </div>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>

        <!-- 3. Logout Button -->
        <div>
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full py-3 bg-white border border-rose-200 hover:bg-rose-50 text-rose-600 font-bold text-xs rounded-2xl transition shadow-xs flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Log out</span>
                </button>
            </form>
        </div>
    </div>

    <!-- RIGHT COLUMN: Detailed Quiz History (2 cols on desktop) -->
    <div class="lg:col-span-2">
        <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-wide uppercase">Quiz History</h3>
                    <p class="text-xs text-slate-400">Past quiz scores and recorded violation metrics</p>
                </div>
                <a href="#" class="text-xs font-semibold text-emerald-800 hover:text-emerald-950 transition">View all</a>
            </div>

            <div class="divide-y divide-slate-100 text-xs">
                <!-- Row 1: Database Quiz 1 (Passed) -->
                <div class="py-4 flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <p class="font-bold text-slate-900 text-sm">Database Quiz 1</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Nov 8 · <span class="text-emerald-700 font-medium">0 violations</span></p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <span class="font-black text-slate-900 text-base">17/20</span>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 uppercase">
                            Passed
                        </span>
                    </div>
                </div>

                <!-- Row 2: Networking 1 (Failed) -->
                <div class="py-4 flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <p class="font-bold text-slate-900 text-sm">Networking 1</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Oct 28 · <span class="text-amber-700 font-medium">2 violations</span></p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <span class="font-black text-slate-900 text-base">14/20</span>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200/60 uppercase">
                            Failed
                        </span>
                    </div>
                </div>

                <!-- Row 3: Programming 1 (Passed) -->
                <div class="py-4 flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <p class="font-bold text-slate-900 text-sm">Programming 1</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Oct 15 · <span class="text-emerald-700 font-medium">0 violations</span></p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <span class="font-black text-slate-900 text-base">19/20</span>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 uppercase">
                            Passed
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
