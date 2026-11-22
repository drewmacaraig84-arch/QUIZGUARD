@extends('layouts.teacher')

@section('title', isset($quiz) ? 'Edit Quiz' : 'Create Quiz')

@section('content')
    @php
        $isEdit = isset($quiz);
        $fresh = !$isEdit && old('title') === null;
    @endphp

    <div class="mb-6">
        <p class="text-xs text-slate-400">Quizzes / {{ $isEdit ? 'Edit' : 'Create' }}</p>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">{{ $isEdit ? 'Edit Quiz' : 'Create Quiz' }}</h1>
    </div>

    @if ($banks->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-8 text-center">
            <p class="text-sm text-slate-600">You need at least one active question bank under this teacher account before
                creating a quiz.</p>
            <a href="/teacher/question-banks"
                class="inline-block mt-4 px-4 py-2 bg-[#11422d] text-white rounded-xl text-xs font-medium">Go to My
                Library</a>
        </div>
    @else
        <form method="POST" action="{{ $isEdit ? '/teacher/quizzes/' . $quiz->quiz_id : '/teacher/quizzes' }}"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @csrf

            <!-- Quiz details -->
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-xs p-6 space-y-4">
                <h2 class="text-base font-bold text-slate-900">Quiz Details</h2>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Quiz title</label>
                    <input type="text" name="title" maxlength="45" required
                        value="{{ old('title', $quiz->title ?? '') }}" placeholder="Enter quiz title"
                        class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Question bank</label>
                        <select name="bank_id" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->bank_id }}"
                                    {{ old('bank_id', $quiz->bank_id ?? '') == $bank->bank_id ? 'selected' : '' }}>
                                    {{ $bank->bank_title }} ({{ $bank->questions_count }} questions)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Section</label>
                        @if ($sections->isEmpty())
                            <p class="text-xs text-rose-600 py-2">No active student sections yet. The admin must add
                                students with a section first.</p>
                        @else
                            <select name="section" required
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                                @foreach ($sections as $section)
                                    <option value="{{ $section }}"
                                        {{ old('section', $quiz->section ?? '') === $section ? 'selected' : '' }}>
                                        {{ $section }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Number of questions</label>
                        <input type="number" min="1" required name="number_of_questions"
                            value="{{ old('number_of_questions', $quiz->number_of_questions ?? '') }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Time limit (minutes)</label>
                        <input type="number" min="1" required name="time_limit_min"
                            value="{{ old('time_limit_min', $quiz->time_limit_min ?? '') }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Passing score (%)</label>
                        <input type="number" min="0" max="100" required name="passing_score"
                            value="{{ old('passing_score', $quiz->passing_score ?? 75) }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Opens at</label>
                        <input type="datetime-local" required name="open_at"
                            value="{{ old('open_at', isset($quiz) && $quiz->open_at ? $quiz->open_at->format('Y-m-d\TH:i') : '') }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Closes at</label>
                        <input type="datetime-local" required name="closed_at"
                            value="{{ old('closed_at', isset($quiz) && $quiz->closed_at ? $quiz->closed_at->format('Y-m-d\TH:i') : '') }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Attempts allowed</label>
                        <input type="number" min="1" required name="attempts_allowed"
                            value="{{ old('attempts_allowed', $quiz->attempts_allowed ?? 1) }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Grading method</label>
                        <select name="grading_method" required
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                            <option value="highest"
                                {{ old('grading_method', $quiz->grading_method ?? '') === 'highest' ? 'selected' : '' }}>
                                Highest score</option>
                            <option value="latest"
                                {{ old('grading_method', $quiz->grading_method ?? '') === 'latest' ? 'selected' : '' }}>
                                Latest score</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Side boxes -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6 space-y-3">
                    <h2 class="text-base font-bold text-slate-900">Randomization</h2>
                    <label class="flex items-center gap-2 text-xs text-slate-700">
                        <input type="checkbox" name="shuffle_questions" value="1"
                            {{ $fresh || old('shuffle_questions', $quiz->shuffle_questions ?? false) ? 'checked' : '' }}>
                        Shuffle questions
                    </label>
                    <label class="flex items-center gap-2 text-xs text-slate-700">
                        <input type="checkbox" name="shuffle_answers" value="1"
                            {{ $fresh || old('shuffle_answers', $quiz->shuffle_answers ?? false) ? 'checked' : '' }}>
                        Shuffle choices
                    </label>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6 space-y-3">
                    <h2 class="text-base font-bold text-slate-900">Anti-Cheat</h2>
                    <p class="text-xs text-slate-500">Always on for every quiz: tab switching, window or app switching,
                        exiting fullscreen, and copy / paste.</p>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Allowed violations</label>
                        <input type="number" min="1" required name="max_violation"
                            value="{{ old('max_violation', $quiz->max_violation ?? 3) }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        <p class="text-[11px] text-slate-400 mt-1">The quiz is submitted automatically when this number is
                            reached.</p>
                    </div>
                </div>

                <button type="submit" @disabled($sections->isEmpty())
                    class="w-full px-4 py-2.5 bg-[#11422d] hover:bg-[#0d3423] disabled:opacity-50 text-white rounded-xl text-xs font-medium transition shadow-xs">
                    {{ $isEdit ? 'Save Changes' : 'Publish Quiz' }}
                </button>
                <a href="/teacher/quizzes" class="block text-center text-xs text-slate-500 hover:text-slate-800">Cancel</a>
            </div>
        </form>
    @endif
@endsection
