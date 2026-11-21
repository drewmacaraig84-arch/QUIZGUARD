@extends('layouts.admin')

@section('title', 'System Health')

@section('content')
<!-- ============================================================ -->
<!-- SCREEN 1: SYSTEM HEALTH (ADMIN DASHBOARD)                   -->
<!-- ============================================================ -->

<!-- Top Title and Actions Row -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">System Health</h1>
            <!-- All Systems Operational Badge -->
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                All systems operational
            </span>
        </div>
        <p class="text-xs text-slate-500 mt-1">Live status of QuizGuard services. Last checked today, 7:31 PM.</p>
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center gap-3">
        <!-- Refresh Button -->
        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-medium transition shadow-xs">
            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Refresh
        </button>

        <!-- Export Logs Button -->
        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition shadow-xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Export Logs
        </button>
    </div>
</div>

<!-- ========================================== -->
<!-- 1. KEY METRICS ROW (4 Cards)               -->
<!-- ========================================== -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <!-- Card 1: Uptime -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">99.94%</p>
            <p class="text-xs text-slate-500 mt-0.5">Uptime (30 days)</p>
            <p class="text-[11px] font-medium text-emerald-600 mt-1">Target: 99.9%</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>
    </div>

    <!-- Card 2: Avg Response Time -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">182 ms</p>
            <p class="text-xs text-slate-500 mt-0.5">Avg response time</p>
            <p class="text-[11px] font-medium text-emerald-600 mt-1 flex items-center gap-1">
                <span>↓</span> 12 ms vs. yesterday
            </p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <!-- Card 3: Active Quiz Sessions -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">27</p>
            <p class="text-xs text-slate-500 mt-0.5">Active quiz sessions</p>
            <p class="text-[11px] text-slate-500 mt-1">Students taking quizzes now</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>

    <!-- Card 4: Errors (24h) -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">6</p>
            <p class="text-xs text-slate-500 mt-0.5">Errors (24h)</p>
            <p class="text-[11px] font-medium text-amber-600 mt-1">Plus 9 warnings</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. MAIN 2-COLUMN GRID (Charts & Status)    -->
<!-- ========================================== -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- LEFT COLUMN: Charts & Recent Errors (2 cols on large screen) -->
    <div class="lg:col-span-2 space-y-6">

        <!-- Errors & Warnings 24h Bar Chart -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
            <div class="mb-6">
                <h2 class="text-base font-bold text-slate-900">Errors & Warnings Over Time</h2>
                <p class="text-xs text-slate-500">Last 24 hours (15 total)</p>
            </div>

            <!-- Student-friendly CSS Bar Histogram -->
            <div class="h-44 flex items-end justify-between gap-2 pt-6 pb-2 px-2 border-b border-slate-100">
                <!-- 8 PM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-400 font-medium">0</span>
                    <div class="w-full max-w-[28px] bg-slate-100 rounded-t h-[4px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">8 PM</span>
                </div>
                <!-- 10 PM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-600 font-medium">1</span>
                    <div class="w-full max-w-[28px] bg-emerald-200/90 rounded-t h-[25px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">10 PM</span>
                </div>
                <!-- 12 AM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-400 font-medium">0</span>
                    <div class="w-full max-w-[28px] bg-slate-100 rounded-t h-[4px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">12 AM</span>
                </div>
                <!-- 2 AM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-400 font-medium">0</span>
                    <div class="w-full max-w-[28px] bg-slate-100 rounded-t h-[4px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">2 AM</span>
                </div>
                <!-- 4 AM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-600 font-medium">2</span>
                    <div class="w-full max-w-[28px] bg-emerald-200/90 rounded-t h-[50px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">4 AM</span>
                </div>
                <!-- 6 AM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-600 font-medium">1</span>
                    <div class="w-full max-w-[28px] bg-emerald-200/90 rounded-t h-[25px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">6 AM</span>
                </div>
                <!-- 8 AM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-400 font-medium">0</span>
                    <div class="w-full max-w-[28px] bg-slate-100 rounded-t h-[4px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">8 AM</span>
                </div>
                <!-- 10 AM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-600 font-medium">2</span>
                    <div class="w-full max-w-[28px] bg-emerald-200/90 rounded-t h-[50px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">10 AM</span>
                </div>
                <!-- 12 PM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-600 font-medium">1</span>
                    <div class="w-full max-w-[28px] bg-emerald-200/90 rounded-t h-[25px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">12 PM</span>
                </div>
                <!-- 2 PM (Amber / Warning Peak) -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-amber-700 font-semibold">3</span>
                    <div class="w-full max-w-[28px] bg-amber-400/80 rounded-t h-[75px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">2 PM</span>
                </div>
                <!-- 4 PM -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-slate-600 font-medium">2</span>
                    <div class="w-full max-w-[28px] bg-emerald-200/90 rounded-t h-[50px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">4 PM</span>
                </div>
                <!-- 6 PM (Amber / Warning Peak) -->
                <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end">
                    <span class="text-[10px] text-amber-700 font-semibold">3</span>
                    <div class="w-full max-w-[28px] bg-amber-400/80 rounded-t h-[75px]"></div>
                    <span class="text-[10px] text-slate-400 mt-1 whitespace-nowrap">6 PM</span>
                </div>
            </div>
        </div>

        <!-- Recent Error Logs Table -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Recent Error Logs</h2>
                    <p class="text-xs text-slate-500">Latest errors and warnings across services</p>
                </div>
                <a href="{{ route('admin.logs') }}" class="text-xs font-semibold text-emerald-800 hover:text-emerald-900 inline-flex items-center gap-1 transition">
                    View all logs <span>→</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100">
                            <th class="pb-3 font-medium">Time</th>
                            <th class="pb-3 font-medium">Level</th>
                            <th class="pb-3 font-medium">Service</th>
                            <th class="pb-3 font-medium">Message</th>
                            <th class="pb-3 font-medium text-right">Count</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <tr>
                            <td class="py-3 font-medium text-slate-600">7:24 PM</td>
                            <td class="py-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-200/60 uppercase">Error</span>
                            </td>
                            <td class="py-3 font-medium text-slate-800">Quiz Monitoring</td>
                            <td class="py-3 text-slate-600">Violation log failed to save. Retry succeeded.</td>
                            <td class="py-3 text-right font-medium text-slate-800">3</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-medium text-slate-600">7:02 PM</td>
                            <td class="py-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60 uppercase">Warning</span>
                            </td>
                            <td class="py-3 font-medium text-slate-800">Database</td>
                            <td class="py-3 text-slate-600">Slow query (2.4 s) on quiz_attempts</td>
                            <td class="py-3 text-right font-medium text-slate-800">5</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-medium text-slate-600">6:48 PM</td>
                            <td class="py-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-200/60 uppercase">Error</span>
                            </td>
                            <td class="py-3 font-medium text-slate-800">File Parser</td>
                            <td class="py-3 text-slate-600">Could not read .docx: unsupported table format</td>
                            <td class="py-3 text-right font-medium text-slate-800">2</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-medium text-slate-600">6:15 PM</td>
                            <td class="py-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200/60 uppercase">Warning</span>
                            </td>
                            <td class="py-3 font-medium text-slate-800">Authentication</td>
                            <td class="py-3 text-slate-600">Repeated failed logins from 192.168.1.58</td>
                            <td class="py-3 text-right font-medium text-slate-800">4</td>
                        </tr>
                        <tr>
                            <td class="py-3 font-medium text-slate-600">5:40 PM</td>
                            <td class="py-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-200/60 uppercase">Error</span>
                            </td>
                            <td class="py-3 font-medium text-slate-800">PDF Export</td>
                            <td class="py-3 text-slate-600">Memory limit reached while generating report</td>
                            <td class="py-3 text-right font-medium text-slate-800">1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- RIGHT COLUMN: Service Status & Resource Usage (1 col) -->
    <div class="space-y-6">

        <!-- Service Status Card -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
            <div class="mb-4">
                <h2 class="text-base font-bold text-slate-900">Service Status</h2>
                <p class="text-xs text-slate-500">Current state of each component</p>
            </div>

            <div class="divide-y divide-slate-100">
                <!-- 1. Web Application -->
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-800">Web Application</p>
                        <p class="text-[11px] text-slate-400">99.98% uptime</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Operational
                    </span>
                </div>

                <!-- 2. Database (MySQL) -->
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-800">Database (MySQL)</p>
                        <p class="text-[11px] text-slate-400">12 ms average query time</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Operational
                    </span>
                </div>

                <!-- 3. Authentication -->
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-800">Authentication</p>
                        <p class="text-[11px] text-slate-400">Local accounts and Google sign-in</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Operational
                    </span>
                </div>

                <!-- 4. Quiz Monitoring -->
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-800">Quiz Monitoring</p>
                        <p class="text-[11px] text-slate-400">Tab, window and full-screen detection</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Operational
                    </span>
                </div>

                <!-- 5. File Processing -->
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-800">File Processing</p>
                        <p class="text-[11px] text-slate-400">.docx parser, PDF and Excel export</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Operational
                    </span>
                </div>
            </div>
        </div>

        <!-- Resource Usage Card -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
            <div class="mb-5">
                <h2 class="text-base font-bold text-slate-900">Resource Usage</h2>
                <p class="text-xs text-slate-500">Server load right now</p>
            </div>

            <div class="space-y-4">
                <!-- CPU -->
                <div>
                    <div class="flex items-center justify-between text-xs font-medium text-slate-700 mb-1.5">
                        <span>CPU</span>
                        <span class="font-bold">38%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-[#11422d] h-2 rounded-full" style="width: 38%"></div>
                    </div>
                </div>

                <!-- Memory -->
                <div>
                    <div class="flex items-center justify-between text-xs font-medium text-slate-700 mb-1.5">
                        <span>Memory</span>
                        <span class="font-bold">61%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-[#11422d] h-2 rounded-full" style="width: 61%"></div>
                    </div>
                </div>

                <!-- Disk -->
                <div>
                    <div class="flex items-center justify-between text-xs font-medium text-slate-700 mb-1.5">
                        <span>Disk</span>
                        <span class="font-bold">54%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-[#11422d] h-2 rounded-full" style="width: 54%"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

