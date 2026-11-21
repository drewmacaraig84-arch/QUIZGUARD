@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<!-- ============================================================ -->
<!-- SCREEN 2: USER MANAGEMENT                                    -->
<!-- ============================================================ -->

<!-- Top Title and Action Buttons -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">User Management</h1>
        <p class="text-xs text-slate-500 mt-1">Manage student and teacher accounts.</p>
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center gap-3">
        <!-- Import CSV Button -->
        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-medium transition shadow-xs">
            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            Import CSV
        </button>

        <!-- Add User Button -->
        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition shadow-xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add User
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
               placeholder="Search by name or email..." 
               class="w-full bg-white text-xs text-slate-700 pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:outline-none transition shadow-xs placeholder-slate-400">
    </div>

    <!-- Center: Role Filter Pills -->
    <div class="inline-flex p-1 bg-white border border-slate-200 rounded-xl shadow-xs text-xs font-medium">
        <button type="button" class="px-4 py-1.5 rounded-lg bg-[#11422d] text-white font-semibold transition">
            All <span class="ml-1 opacity-90">336</span>
        </button>
        <button type="button" class="px-4 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 transition">
            Students <span class="ml-1 text-slate-400">298</span>
        </button>
        <button type="button" class="px-4 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 transition">
            Teachers <span class="ml-1 text-slate-400">38</span>
        </button>
    </div>

    <!-- Right Dropdown Filters -->
    <div class="flex items-center gap-3">
        <!-- Section Filter -->
        <button type="button" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-700 hover:bg-slate-50 transition shadow-xs">
            <span>Section: All</span>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Status Filter -->
        <button type="button" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-700 hover:bg-slate-50 transition shadow-xs">
            <span>Status: All</span>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. USERS DATA TABLE                        -->
<!-- ========================================== -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                    <th class="py-3.5 px-6 font-medium">Name</th>
                    <th class="py-3.5 px-6 font-medium">Email</th>
                    <th class="py-3.5 px-6 font-medium">Role</th>
                    <th class="py-3.5 px-6 font-medium">Section / Dept</th>
                    <th class="py-3.5 px-6 font-medium">Status</th>
                    <th class="py-3.5 px-6 font-medium">Last login</th>
                    <th class="py-3.5 px-6 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700 font-normal">
                <!-- User 1: Maria Santos -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[11px] flex items-center justify-center shrink-0">
                                MS
                            </div>
                            <span class="font-bold text-slate-900">Maria Santos</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">maria.santos@dwcc.edu.ph</td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            Student
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">BSIT 3A</td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">Today, 9:12 AM</td>
                    <td class="py-3.5 px-6 text-right">
                        <div class="inline-flex items-center gap-2 text-slate-400">
                            <button type="button" class="hover:text-slate-700 transition" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </button>
                            <button type="button" class="hover:text-slate-700 transition" title="Reset Password">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                            </button>
                            <button type="button" class="hover:text-rose-600 transition" title="Delete">
                                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- User 2: Jose Dela Cruz -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold text-[11px] flex items-center justify-center shrink-0">
                                JD
                            </div>
                            <span class="font-bold text-slate-900">Jose Dela Cruz</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">jose.delacruz@dwcc.edu.ph</td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            Student
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">BSIT 3A</td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">Today, 8:47 AM</td>
                    <td class="py-3.5 px-6 text-right">
                        <div class="inline-flex items-center gap-2 text-slate-400">
                            <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                            <button type="button" class="hover:text-slate-700 transition" title="Reset Password"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg></button>
                            <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </div>
                    </td>
                </tr>

                <!-- User 3: Angelica Reyes -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-800 font-bold text-[11px] flex items-center justify-center shrink-0">
                                AR
                            </div>
                            <span class="font-bold text-slate-900">Angelica Reyes</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">angelica.reyes@dwcc.edu.ph</td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">
                            Teacher
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">IT Department</td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">Today, 7:55 AM</td>
                    <td class="py-3.5 px-6 text-right">
                        <div class="inline-flex items-center gap-2 text-slate-400">
                            <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                            <button type="button" class="hover:text-slate-700 transition" title="Reset Password"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg></button>
                            <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </div>
                    </td>
                </tr>

                <!-- User 4: Mark Villanueva -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[11px] flex items-center justify-center shrink-0">
                                MV
                            </div>
                            <span class="font-bold text-slate-900">Mark Villanueva</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">mark.villanueva@dwcc.edu.ph</td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            Student
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">BSIT 2A</td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">Yesterday</td>
                    <td class="py-3.5 px-6 text-right">
                        <div class="inline-flex items-center gap-2 text-slate-400">
                            <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                            <button type="button" class="hover:text-slate-700 transition" title="Reset Password"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg></button>
                            <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </div>
                    </td>
                </tr>

                <!-- User 5: Roberto Aquino -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-800 font-bold text-[11px] flex items-center justify-center shrink-0">
                                RA
                            </div>
                            <span class="font-bold text-slate-900">Roberto Aquino</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">roberto.aquino@dwcc.edu.ph</td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">
                            Teacher
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">CS Department</td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">Nov 11, 2026</td>
                    <td class="py-3.5 px-6 text-right">
                        <div class="inline-flex items-center gap-2 text-slate-400">
                            <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                            <button type="button" class="hover:text-slate-700 transition" title="Reset Password"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg></button>
                            <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </div>
                    </td>
                </tr>

                <!-- User 6: Sofia Ramos -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[11px] flex items-center justify-center shrink-0">
                                SR
                            </div>
                            <span class="font-bold text-slate-900">Sofia Ramos</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">sofia.ramos@dwcc.edu.ph</td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            Student
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">BSIT 4B</td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            Inactive
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">Oct 28, 2026</td>
                    <td class="py-3.5 px-6 text-right">
                        <div class="inline-flex items-center gap-2 text-slate-400">
                            <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                            <button type="button" class="hover:text-slate-700 transition" title="Reset Password"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg></button>
                            <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </div>
                    </td>
                </tr>

                <!-- User 7: Patricia Lim -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-800 font-bold text-[11px] flex items-center justify-center shrink-0">
                                PL
                            </div>
                            <span class="font-bold text-slate-900">Patricia Lim</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">patricia.lim@dwcc.edu.ph</td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">
                            Teacher
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">CS Department</td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">Yesterday</td>
                    <td class="py-3.5 px-6 text-right">
                        <div class="inline-flex items-center gap-2 text-slate-400">
                            <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                            <button type="button" class="hover:text-slate-700 transition" title="Reset Password"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg></button>
                            <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </div>
                    </td>
                </tr>

                <!-- User 8: Kevin Mendoza -->
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[11px] flex items-center justify-center shrink-0">
                                KM
                            </div>
                            <span class="font-bold text-slate-900">Kevin Mendoza</span>
                        </div>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">kevin.mendoza@dwcc.edu.ph</td>
                    <td class="py-3.5 px-6">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                            Student
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">BSIT 1A</td>
                    <td class="py-3.5 px-6">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Pending
                        </span>
                    </td>
                    <td class="py-3.5 px-6 text-slate-600">Never</td>
                    <td class="py-3.5 px-6 text-right">
                        <div class="inline-flex items-center gap-2 text-slate-400">
                            <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                            <button type="button" class="hover:text-slate-700 transition" title="Reset Password"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg></button>
                            <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Table Pagination Footer -->
    <div class="px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
        <div>
            Showing <span class="font-semibold text-slate-700">1-8</span> of <span class="font-semibold text-slate-700">336</span> users
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
                42
            </button>
            <button type="button" class="w-8 h-8 rounded-lg border border-slate-200 bg-white text-slate-500 hover:bg-slate-50 flex items-center justify-center transition shadow-xs">
                &gt;
            </button>
        </div>
    </div>
</div>
@endsection

