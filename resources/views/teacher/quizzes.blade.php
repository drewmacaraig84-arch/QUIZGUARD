@extends('layouts.teacher')

@section('title', 'Quizzes')

@section('content')
@php $now = now(); @endphp

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Quizzes</h1>
        <p class="text-xs text-slate-500 mt-1">Manage your active and inactive quizzes.</p>
    </div>
    <a href="/teacher/quizzes/create" class="inline-flex items-center gap-2 px-4 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition shadow-xs">+ Create Quiz</a>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                    <th class="py-3.5 px-6 font-medium">Quiz</th>
                    <th class="py-3.5 px-6 font-medium">Section</th>
                    <th class="py-3.5 px-6 font-medium">Items</th>
                    <th class="py-3.5 px-6 font-medium">Opens</th>
                    <th class="py-3.5 px-6 font-medium">Closes</th>
                    <th class="py-3.5 px-6 font-medium">Status</th>
                    <th class="py-3.5 px-6 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                @forelse ($quizzes as $quiz)
                    <tr class="hover:bg-slate-50/60 transition {{ $quiz->status === 'inactive' ? 'opacity-70' : '' }}">
                        <td class="py-3.5 px-6"><span class="font-bold text-slate-900">{{ $quiz->title }}</span><br><span class="text-slate-400">{{ $quiz->subject->subject_code ?? '' }}</span></td>
                        <td class="py-3.5 px-6 text-slate-600">{{ $quiz->section }}</td>
                        <td class="py-3.5 px-6 text-slate-600">{{ $quiz->number_of_questions }}</td>
                        <td class="py-3.5 px-6 text-slate-600 whitespace-nowrap">{{ $quiz->open_at?->format('M d, g:i A') }}</td>
                        <td class="py-3.5 px-6 text-slate-600 whitespace-nowrap">{{ $quiz->closed_at?->format('M d, g:i A') }}</td>
                        <td class="py-3.5 px-6">
                            @if ($quiz->status === 'inactive')
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-rose-50 text-rose-700 border border-rose-200/60">Inactive</span>
                            @elseif ($quiz->open_at && $now->lt($quiz->open_at))
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200/60">Scheduled</span>
                            @elseif ($quiz->closed_at && $now->gt($quiz->closed_at))
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200">Closed</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">Open</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-6 text-right">
                            <div class="inline-flex items-center gap-4">
                                <a href="/teacher/quizzes/{{ $quiz->quiz_id }}/results" class="font-medium text-emerald-700 hover:text-emerald-900">Results</a>
                                @if ($quiz->status === 'active')
                                    <form method="POST" action="/teacher/quizzes/{{ $quiz->quiz_id }}/deactivate">
                                        @csrf
                                        <button type="submit" class="font-medium text-rose-600 hover:text-rose-800">Deactivate</button>
                                    </form>
                                @else
                                    <form method="POST" action="/teacher/quizzes/{{ $quiz->quiz_id }}/activate">
                                        @csrf
                                        <button type="submit" class="font-medium text-emerald-700 hover:text-emerald-900">Activate</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="py-8 px-6 text-center text-slate-400">No quizzes yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection