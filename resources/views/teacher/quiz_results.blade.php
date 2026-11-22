@extends('layouts.teacher')

@section('title', 'Quiz Results')

@section('content')
@php
    $submitted   = $results->count();
    $highest     = $results->max(fn ($r) => $r['counted']->percentage) ?? 0;
    $violations  = $attempts->sum('violation_count');
    $passingRate = $submitted > 0 ? round($passed / $submitted * 100) : 0;
@endphp

<div class="mb-6">
    <a href="/teacher/quizzes" class="text-xs text-slate-400 hover:text-slate-700">&larr; Quizzes</a>
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight mt-1">{{ $quiz->title }}</h1>
    <p class="text-xs text-slate-500 mt-1">
        {{ $quiz->subject->subject_code ?? '' }} &middot; Section {{ $quiz->section }} &middot;
        Grading: {{ $quiz->grading_method === 'highest' ? 'highest attempt' : 'latest attempt' }} counts
    </p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    @foreach ([['Average score', $average . '%'], ['Students submitted', $submitted], ['Highest score', $highest . '%'], ['Total violations', $violations]] as [$label, $value])
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-xs">
            <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $value }}</p>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">{{ $label }}</p>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                        <th class="py-3.5 px-6 font-medium">Student</th>
                        <th class="py-3.5 px-6 font-medium">Student ID</th>
                        <th class="py-3.5 px-6 font-medium">Score</th>
                        <th class="py-3.5 px-6 font-medium">Submitted</th>
                        <th class="py-3.5 px-6 font-medium">Violations</th>
                        <th class="py-3.5 px-6 font-medium">Tries</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($results as $r)
                        @php $a = $r['counted']; @endphp
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6 font-bold text-slate-900">{{ $r['student']->first_name }} {{ $r['student']->last_name }}</td>
                            <td class="py-3.5 px-6 text-slate-600">{{ $r['student']->school_id_num }}</td>
                            <td class="py-3.5 px-6 text-slate-600 whitespace-nowrap">{{ $a->score }}/{{ $a->total_points }} ({{ $a->percentage }}%)</td>
                            <td class="py-3.5 px-6 text-slate-600 whitespace-nowrap">
                                {{ $a->submitted_at?->format('M d, g:i A') }}
                                @if ($a->status === 'auto_submitted')
                                    <span class="ml-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-rose-50 text-rose-700 border border-rose-200/60">Auto-submitted</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-6 text-slate-600">{{ $a->violation_count }}</td>
                            <td class="py-3.5 px-6 text-slate-600">{{ $r['attempts'] }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 px-6 text-center text-slate-400">No results available yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6">
        <h2 class="text-base font-bold text-slate-900">Summary</h2>
        <div class="mt-4 space-y-3 text-sm text-slate-600">
            <p>Passing score: <strong class="text-slate-900">{{ $quiz->passing_score }}%</strong></p>
            <p>Passed: <strong class="text-slate-900">{{ $passed }} of {{ $submitted }}</strong></p>
            <p>Passing rate: <strong class="text-slate-900">{{ $passingRate }}%</strong></p>
        </div>
    </div>
</div>
@endsection