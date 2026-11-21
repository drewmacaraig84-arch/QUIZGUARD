@extends('layouts.admin')

@section('title', 'System Logs')

@section('content')
<!-- ============================================================ -->
<!-- SCREEN 4: SYSTEM LOGS                                        -->
<!-- ============================================================ -->

<!-- Top Title and Action Button -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">System Logs</h1>
        <p class="text-xs text-slate-500 mt-1">Audit trail of actions across QuizGuard.</p>
    </div>

    <!-- Export Logs Button -->
    <div>
        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition shadow-xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Export Logs
        </button>
    </div>
</div>

<!-- ========================================== -->
<!-- 1. SEARCH & FILTERS BAR                    -->
<!-- ========================================== -->
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
    <!-- Search Input -->
    <div class="relative w-full lg:w-80">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </span>
        <input type="text" 
               placeholder="Search logs..." 
               class="w-full bg-white text-xs text-slate-700 pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:outline-none transition shadow-xs placeholder-slate-400">
    </div>

    <!-- Filter Dropdowns -->
    <div class="flex flex-wrap items-center gap-3">
        <!-- Date Filter -->
        <button type="button" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-700 hover:bg-slate-50 transition shadow-xs">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>Date: Last 7 days</span>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- User Filter -->
        <button type="button" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-700 hover:bg-slate-50 transition shadow-xs">
            <span>User: All</span>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Action Filter -->
        <button type="button" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-700 hover:bg-slate-50 transition shadow-xs">
            <span>Action: All</span>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. AUDIT LOGS DATA TABLE                   -->
<!-- ========================================== -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                    <th class="py-3.5 px-6 font-medium">Timestamp</th>
                    <th class="py-3.5 px-6 font-medium">User</th>
                    <th class="py-3.5 px-6 font-medium">Role</th>
                    <th class="py-3.5 px-6 font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700 font-normal">
                <!-- Log 1: Maria Santos -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 13, 9:12 AM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[10px] flex items-center justify-center shrink-0">
                                MS
                            </div>
                            <span class="font-bold text-slate-900">Maria Santos</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            Student
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Submitted quiz</td>
                </tr>

                <!-- Log 2: Jose Dela Cruz -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 13, 8:47 AM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px] flex items-center justify-center shrink-0">
                                JD
                            </div>
                            <span class="font-bold text-slate-900">Jose Dela Cruz</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            Student
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Violation: tab switching</td>
                </tr>

                <!-- Log 3: Angelica Reyes -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 13, 7:55 AM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-amber-100 text-amber-800 font-bold text-[10px] flex items-center justify-center shrink-0">
                                AR
                            </div>
                            <span class="font-bold text-slate-900">Angelica Reyes</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">
                            Teacher
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Published quiz</td>
                </tr>

                <!-- Log 4: Elena Bautista -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 12, 4:30 PM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-slate-800 text-white font-bold text-[10px] flex items-center justify-center shrink-0">
                                EB
                            </div>
                            <span class="font-bold text-slate-900">Elena Bautista</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-800 text-white">
                            Admin
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Added subject (ITP114)</td>
                </tr>

                <!-- Log 5: Angelica Reyes -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 12, 3:18 PM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-amber-100 text-amber-800 font-bold text-[10px] flex items-center justify-center shrink-0">
                                AR
                            </div>
                            <span class="font-bold text-slate-900">Angelica Reyes</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">
                            Teacher
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Exported report (PDF)</td>
                </tr>

                <!-- Log 6: Elena Bautista -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 12, 1:05 PM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-slate-800 text-white font-bold text-[10px] flex items-center justify-center shrink-0">
                                EB
                            </div>
                            <span class="font-bold text-slate-900">Elena Bautista</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-800 text-white">
                            Admin
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Created user account</td>
                </tr>

                <!-- Log 7: Roberto Aquino -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 11, 5:42 PM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-amber-100 text-amber-800 font-bold text-[10px] flex items-center justify-center shrink-0">
                                RA
                            </div>
                            <span class="font-bold text-slate-900">Roberto Aquino</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">
                            Teacher
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Uploaded question bank</td>
                </tr>

                <!-- Log 8: Elena Bautista -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 11, 2:10 PM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-slate-800 text-white font-bold text-[10px] flex items-center justify-center shrink-0">
                                EB
                            </div>
                            <span class="font-bold text-slate-900">Elena Bautista</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-800 text-white">
                            Admin
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Deactivated user account</td>
                </tr>

                <!-- Log 9: System -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6 text-slate-500 whitespace-nowrap">Nov 10, 9:00 AM</td>
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-slate-200 text-slate-700 font-bold text-[10px] flex items-center justify-center shrink-0">
                                SY
                            </div>
                            <span class="font-bold text-slate-900">System</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                            System
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-700 font-medium">Auto-deleted expired records</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination Footer -->
    <div class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
        <div>
            Showing <span class="font-semibold text-slate-700">1-9</span> of <span class="font-semibold text-slate-700">1,206</span> log entries
        </div>

        <div class="inline-flex items-center gap-1">
            <button type="button" class="w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 flex items-center justify-center transition shadow-xs">
                &lt;
            </button>
            <button type="button" class="w-8 h-8 rounded-lg bg-[#11422d] text-white font-bold flex items-center justify-center shadow-xs">
                1
            </button>
            <button type="button" class="w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 flex items-center justify-center transition shadow-xs">
                2
            </button>
            <button type="button" class="w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 flex items-center justify-center transition shadow-xs">
                3
            </button>
            <span class="px-2 text-slate-400">...</span>
            <button type="button" class="w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 flex items-center justify-center transition shadow-xs">
                134
            </button>
            <button type="button" class="w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 flex items-center justify-center transition shadow-xs">
                &gt;
            </button>
        </div>
    </div>
</div>
@endsection

