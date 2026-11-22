@extends('layouts.admin')

@section('title', 'Sections & Subjects')

@section('content')
<!-- Top Title and Action Buttons -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Sections & Subjects</h1>
        <p class="text-xs text-slate-500 mt-1">Class sections come from the students. Subjects are managed here.</p>
    </div>

    <!-- Add Subject (opens without JavaScript) -->
    <details class="relative">
        <summary class="list-none cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition shadow-xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Subject
        </summary>
        <form method="POST" action="/admin/subjects" class="absolute right-0 mt-2 w-72 bg-white border border-slate-200 rounded-2xl shadow-lg p-4 space-y-2 z-30">
            @csrf
            <input name="subject_code" value="{{ old('subject_code') }}" placeholder="Code (e.g. ITP108L)" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
            <input name="subject_name" value="{{ old('subject_name') }}" placeholder="Subject name" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
            <button type="submit" class="w-full px-4 py-2 bg-[#11422d] text-white rounded-xl text-xs font-medium">Save subject</button>
        </form>
    </details>
</div>

<!-- 1. STAT CARDS ROW -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <!-- Card 1: Sections -->
    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $stats['sections'] }}</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Sections</p>
            <p class="text-[11px] text-slate-400 mt-0.5">With enrolled students</p>
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
            <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $stats['subjects'] }}</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Subjects</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Active</p>
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
            <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $stats['students'] }}</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Students</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Across all sections</p>
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
            <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $stats['teachers'] }}</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Teachers</p>
            <p class="text-[11px] text-slate-400 mt-0.5">Registered</p>
        </div>
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
    </div>
</div>

<!-- 2. TWO-COLUMN SPLIT TABLES -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- LEFT COLUMN: SECTIONS TABLE -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between">
        <div>
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-base font-bold text-slate-900">Sections</h2>
                <p class="text-xs text-slate-500">Taken from the students' sections</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                            <th class="py-3 px-6 font-medium">Section</th>
                            <th class="py-3 px-6 font-medium">Students</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($sections as $section)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">{{ $section->section }}</td>
                            <td class="py-3.5 px-6 text-slate-600">{{ $section->total }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="py-8 px-6 text-center text-slate-400">No sections yet. They appear when students are added.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 text-xs text-slate-500">
            <span class="font-semibold text-slate-700">{{ $sections->count() }}</span> sections
        </div>
    </div>

    <!-- RIGHT COLUMN: SUBJECTS TABLE -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between">
        <div>
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-base font-bold text-slate-900">Subjects</h2>
                <p class="text-xs text-slate-500">Subjects offered</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                            <th class="py-3 px-6 font-medium">Code</th>
                            <th class="py-3 px-6 font-medium">Subject</th>
                            <th class="py-3 px-6 font-medium">Status</th>
                            <th class="py-3 px-6 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($subjects as $subject)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">{{ $subject->subject_code }}</td>
                            <td class="py-3.5 px-6 text-slate-600">{{ $subject->subject_name }}</td>
                            <td class="py-3.5 px-6">
                                @if ($subject->status === 'active')
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">Active</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-6 text-right">
                                <form method="POST" action="/admin/subjects/{{ $subject->subject_id }}/toggle">
                                    @csrf
                                    <button type="submit" class="text-xs font-medium text-slate-600 hover:text-slate-900">{{ $subject->status === 'active' ? 'Deactivate' : 'Activate' }}</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="py-8 px-6 text-center text-slate-400">No subjects yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 text-xs text-slate-500">
            <span class="font-semibold text-slate-700">{{ $subjects->count() }}</span> subjects
        </div>
    </div>
</div>
@endsection