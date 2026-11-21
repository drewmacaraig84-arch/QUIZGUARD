@extends('layouts.admin')

@section('title', 'Sections & Subjects')

@section('content')
<!-- ============================================================ -->
<!-- SCREEN 3: SECTIONS & SUBJECTS                                -->
<!-- ============================================================ -->

<!-- Top Title and Action Buttons -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Sections & Subjects</h1>
        <p class="text-xs text-slate-500 mt-1">Manage class sections and the subjects assigned to them.</p>
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center gap-3">
        <!-- Add Section Button -->
        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-medium transition shadow-xs">
            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Section
        </button>

        <!-- Add Subject Button -->
        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition shadow-xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Subject
        </button>
    </div>
</div>

<!-- ========================================== -->
<!-- 1. STAT CARDS ROW (4 Cards)                -->
<!-- ========================================== -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <!-- Card 1: Sections -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">12</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Sections</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Current term</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>

    <!-- Card 2: Subjects -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">9</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Subjects</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Offered this term</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
    </div>

    <!-- Card 3: Students -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">298</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Students</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Enrolled across sections</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>

    <!-- Card 4: Teachers -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">38</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Teachers</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Assigned to sections</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. TWO-COLUMN SPLIT TABLES                 -->
<!-- ========================================== -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- LEFT COLUMN: SECTIONS TABLE -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between">
        <div>
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-base font-bold text-slate-900">Sections</h2>
                <p class="text-xs text-slate-500">Class sections and their advisers</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                            <th class="py-3 px-6 font-medium">Section</th>
                            <th class="py-3 px-6 font-medium">Adviser</th>
                            <th class="py-3 px-6 font-medium">Students</th>
                            <th class="py-3 px-6 font-medium">Subjects</th>
                            <th class="py-3 px-6 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <!-- Row 1: BSIT 1A -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">BSIT 1A</td>
                            <td class="py-3.5 px-6 text-slate-600">Roberto Aquino</td>
                            <td class="py-3.5 px-6 text-slate-600">38</td>
                            <td class="py-3.5 px-6 text-slate-600">5</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete">
                                        <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2: BSIT 2A -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">BSIT 2A</td>
                            <td class="py-3.5 px-6 text-slate-600">Angelica Reyes</td>
                            <td class="py-3.5 px-6 text-slate-600">41</td>
                            <td class="py-3.5 px-6 text-slate-600">6</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3: BSIT 2B -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">BSIT 2B</td>
                            <td class="py-3.5 px-6 text-slate-600">Patricia Lim</td>
                            <td class="py-3.5 px-6 text-slate-600">39</td>
                            <td class="py-3.5 px-6 text-slate-600">6</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4: BSIT 3A -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">BSIT 3A</td>
                            <td class="py-3.5 px-6 text-slate-600">Angelica Reyes</td>
                            <td class="py-3.5 px-6 text-slate-600">42</td>
                            <td class="py-3.5 px-6 text-slate-600">7</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5: BSIT 3B -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">BSIT 3B</td>
                            <td class="py-3.5 px-6 text-slate-600">Marco Salvador</td>
                            <td class="py-3.5 px-6 text-slate-600">37</td>
                            <td class="py-3.5 px-6 text-slate-600">7</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 6: BSIT 4A -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">BSIT 4A</td>
                            <td class="py-3.5 px-6 text-slate-600">Liza Navarro</td>
                            <td class="py-3.5 px-6 text-slate-600">33</td>
                            <td class="py-3.5 px-6 text-slate-600">5</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 7: BSIT 4B -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">BSIT 4B</td>
                            <td class="py-3.5 px-6 text-slate-600">Roberto Aquino</td>
                            <td class="py-3.5 px-6 text-slate-600">35</td>
                            <td class="py-3.5 px-6 text-slate-600">5</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 text-xs text-slate-500">
            Showing <span class="font-semibold text-slate-700">1-7</span> of <span class="font-semibold text-slate-700">12</span> sections
        </div>
    </div>

    <!-- RIGHT COLUMN: SUBJECTS TABLE -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between">
        <div>
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-base font-bold text-slate-900">Subjects</h2>
                <p class="text-xs text-slate-500">Subjects and their assigned teachers</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                            <th class="py-3 px-6 font-medium">Code</th>
                            <th class="py-3 px-6 font-medium">Subject</th>
                            <th class="py-3 px-6 font-medium">Teacher</th>
                            <th class="py-3 px-6 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <!-- Row 1: ITP102 -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">ITP102</td>
                            <td class="py-3.5 px-6 text-slate-600">Data Structures</td>
                            <td class="py-3.5 px-6 text-slate-600">Patricia Lim</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2: ITP104 -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">ITP104</td>
                            <td class="py-3.5 px-6 text-slate-600">Advanced Database</td>
                            <td class="py-3.5 px-6 text-slate-600">Angelica Reyes</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3: ITP106 -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">ITP106</td>
                            <td class="py-3.5 px-6 text-slate-600">Web Development</td>
                            <td class="py-3.5 px-6 text-slate-600">Roberto Aquino</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4: ITP108L -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">ITP108L</td>
                            <td class="py-3.5 px-6 text-slate-600">Systems Integration & Architecture</td>
                            <td class="py-3.5 px-6 text-slate-600">Angelica Reyes</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5: ITP110 -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">ITP110</td>
                            <td class="py-3.5 px-6 text-slate-600">Networking 2</td>
                            <td class="py-3.5 px-6 text-slate-600">Marco Salvador</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 6: ITP112 -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">ITP112</td>
                            <td class="py-3.5 px-6 text-slate-600">Information Assurance</td>
                            <td class="py-3.5 px-6 text-slate-600">Liza Navarro</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 7: ITP114 -->
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">ITP114</td>
                            <td class="py-3.5 px-6 text-slate-600">Capstone Project 1</td>
                            <td class="py-3.5 px-6 text-slate-600">Roberto Aquino</td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="inline-flex items-center gap-2 text-slate-400">
                                    <button type="button" class="hover:text-slate-700 transition" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                                    <button type="button" class="hover:text-rose-600 transition" title="Delete"><svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 text-xs text-slate-500">
            Showing <span class="font-semibold text-slate-700">1-7</span> of <span class="font-semibold text-slate-700">9</span> subjects
        </div>
    </div>

</div>
@endsection

