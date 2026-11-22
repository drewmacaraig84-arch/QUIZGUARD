@extends('layouts.teacher')

@section('title', 'My Library')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">My Library</h1>
        <p class="text-xs text-slate-500 mt-1">Question banks you uploaded. Quizzes pick their questions from these.</p>
    </div>

    <div class="flex items-center gap-3">
        @if ($banks->where('status', 'active')->isNotEmpty())
            <a href="/teacher/quizzes/create" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-medium transition shadow-xs">
                + Create Quiz
            </a>
        @endif

        <details class="relative" {{ $errors->any() ? 'open' : '' }}>
            <summary class="list-none cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition shadow-xs">
                + Upload Question Bank
            </summary>
            <form method="POST" action="/teacher/question-banks" enctype="multipart/form-data" class="absolute right-0 mt-2 w-80 bg-white border border-slate-200 rounded-2xl shadow-lg p-4 space-y-3 z-30">
                @csrf
                <input name="bank_title" value="{{ old('bank_title') }}" maxlength="45" required placeholder="Bank title" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">

                @if ($subjects->isEmpty())
                    <p class="text-xs text-rose-600">No subjects yet. Ask the admin to add one first.</p>
                @else
                    <select name="subject_id" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->subject_id }}" {{ old('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                                {{ $subject->subject_code }} - {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                @endif

                <input type="file" name="file" accept=".docx,.pdf,.txt" required class="w-full text-xs">
                <p class="text-[11px] text-slate-500">Word, PDF or text file, max 5MB. See the format below.</p>
                <button type="submit" @disabled($subjects->isEmpty()) class="w-full px-4 py-2 bg-[#11422d] disabled:opacity-50 text-white rounded-xl text-xs font-medium">Upload</button>
            </form>
        </details>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Banks table -->
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-slate-400 border-b border-slate-100 bg-slate-50/50">
                        <th class="py-3.5 px-6 font-medium">Question bank</th>
                        <th class="py-3.5 px-6 font-medium">Subject</th>
                        <th class="py-3.5 px-6 font-medium">Questions</th>
                        <th class="py-3.5 px-6 font-medium">Status</th>
                        <th class="py-3.5 px-6 font-medium">Uploaded</th>
                        <th class="py-3.5 px-6 font-medium text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($banks as $bank)
                        <tr class="hover:bg-slate-50/60 transition {{ $bank->status === 'inactive' ? 'opacity-70' : '' }}">
                            <td class="py-3.5 px-6">
                                <span class="font-bold text-slate-900">{{ $bank->bank_title }}</span><br>
                                <span class="text-slate-400">{{ $bank->source_file_name }}</span>
                            </td>
                            <td class="py-3.5 px-6 text-slate-600">{{ $bank->subject->subject_code ?? '-' }}</td>
                            <td class="py-3.5 px-6 text-slate-600">{{ $bank->questions_count }}</td>
                            <td class="py-3.5 px-6">
                                @if ($bank->status === 'active')
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">Active</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-rose-50 text-rose-700 border border-rose-200/60">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-6 text-slate-600 whitespace-nowrap">{{ \Carbon\Carbon::parse($bank->uploaded_at)->format('M d, g:i A') }}</td>
                            <td class="py-3.5 px-6 text-right">
                                @if ($bank->status === 'active')
                                    <form method="POST" action="/teacher/question-banks/{{ $bank->bank_id }}/archive">
                                        @csrf
                                        <button type="submit" class="text-xs font-medium text-rose-600 hover:text-rose-800">Deactivate</button>
                                    </form>
                                @else
                                    <form method="POST" action="/teacher/question-banks/{{ $bank->bank_id }}/activate">
                                        @csrf
                                        <button type="submit" class="text-xs font-medium text-emerald-700 hover:text-emerald-900">Activate</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-8 px-6 text-center text-slate-400">No question banks yet. Upload your first one.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- File format help -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6">
        <h2 class="text-base font-bold text-slate-900">File format</h2>
        <p class="text-xs text-slate-500 mb-3">Write each question like this, with a blank line between questions. Type the letters by hand.</p>
<pre class="text-[11px] bg-slate-50 border border-slate-100 rounded-xl p-3 overflow-x-auto leading-relaxed">Q: What is the capital of France?
A. Paris
B. London
C. Rome
D. Madrid
ANSWER: A
POINTS: 2

Q: Which protocol loads web pages securely?
ANSWER: HTTPS</pre>
        <p class="text-[11px] text-slate-500 mt-3">Questions without choices are identification questions. POINTS is optional (default 1).</p>
    </div>
</div>
@endsection