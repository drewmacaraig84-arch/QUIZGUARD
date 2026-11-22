@php $hideNav = true; @endphp
@extends('layouts.student')

@section('title', 'Advance Database Exam Room')

@section('content')
<!-- ============================================================ -->
<!-- 05 - ACTIVE EXAM ROOM (RESPONSIVE: MOBILE & DESKTOP)          -->
<!-- ============================================================ -->

<!-- Top Dedicated Exam Header (Desktop & Mobile) -->
<div class="bg-[#11422d] text-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center shadow-xs">
            <span class="text-[#11422d] font-black text-lg">Q</span>
        </div>
        <div>
            <span class="text-xs font-black tracking-wider uppercase text-white block leading-tight">DWCC QUIZGUARD</span>
            <p class="text-[10px] text-emerald-200 font-semibold uppercase tracking-wider">Advance Database · Exam Mode</p>
        </div>
    </div>

    <!-- Center Exam Indicators (Visible on tablet/desktop) -->
    <div class="hidden md:flex items-center gap-4">
        <div class="flex items-center gap-2 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 text-xs">
            <span class="text-emerald-200">Progress:</span>
            <span class="font-bold text-white">Question 6 of 20</span>
        </div>

        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-100 font-bold text-xs">
            <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>18:42 left</span>
        </div>
    </div>

    <!-- Exit button -->
    <a href="{{ route('student.quizzes') }}" 
       onclick="return confirm('Are you sure you want to exit? Your exam will not be submitted.');"
       class="text-xs text-emerald-200 hover:text-white transition flex items-center gap-1.5 px-3 py-1.5 rounded-xl hover:bg-white/10 border border-white/10">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span>Exit Quiz</span>
    </a>
</div>

<!-- Main Exam Body: 2-Column on Desktop, 1-Column on Mobile -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

    <!-- LEFT COLUMN: Question & Answer (8 cols on desktop) -->
    <div class="lg:col-span-8 space-y-5">

        <!-- Mobile-Only Progress & Countdown Row -->
        <div class="flex md:hidden items-center justify-between">
            <div>
                <h1 class="text-base font-extrabold text-slate-900 tracking-tight">Question 6 of 20</h1>
                <p class="text-xs text-slate-500">Advance Database</p>
            </div>

            <!-- Mobile Timer Badge -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200/60 text-emerald-800 font-bold text-xs shadow-xs">
                <svg class="w-3.5 h-3.5 text-emerald-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>18:42 left</span>
            </div>
        </div>

        <!-- Live Anti-Cheat Active Pill -->
        <div class="bg-emerald-50/80 border border-emerald-200/70 px-4 py-2.5 rounded-2xl flex items-center justify-between text-xs font-semibold text-emerald-800">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Anti-cheat monitoring is active</span>
            </div>
            <span class="text-[11px] font-normal text-emerald-700 hidden sm:inline">All tabs and keystrokes are audited</span>
        </div>

        <!-- Question Card -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-xs space-y-5">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full">
                    Identification · 1 Point
                </span>
                <span class="text-xs text-slate-400">Single Answer</span>
            </div>

            <!-- Question Text -->
            <h2 class="text-base sm:text-lg font-bold text-slate-900 leading-snug">
                What is the process of organizing database tables to reduce redundancy and improve data integrity?
            </h2>

            <!-- Answer Field -->
            <div class="space-y-2 pt-2">
                <label for="studentAnswer" class="text-xs font-bold text-slate-700 block uppercase tracking-wider">
                    Your answer
                </label>
                <input type="text" 
                       id="studentAnswer" 
                       value="Normalization" 
                       class="w-full bg-slate-50/60 text-slate-900 text-sm sm:text-base font-medium px-4 py-3 rounded-xl border-2 border-slate-300 focus:bg-white focus:border-[#11422d] focus:ring-2 focus:ring-emerald-100 focus:outline-none transition">
                <p class="text-xs text-slate-500">
                    Identification: type your exact answer in the box above. Spelling counts.
                </p>
            </div>
        </div>

        <!-- Question Navigation Buttons -->
        <div class="flex items-center justify-between gap-4 pt-2">
            <button type="button" class="py-3 px-6 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold rounded-xl transition shadow-xs flex items-center gap-2">
                <span>←</span>
                <span>Previous</span>
            </button>
            <button type="button" onclick="openSubmitModal()" class="py-3 px-6 bg-[#11422d] hover:bg-[#0d3423] text-white text-xs sm:text-sm font-bold rounded-xl transition shadow-xs flex items-center gap-2">
                <span>Next question</span>
                <span>→</span>
            </button>
        </div>

    </div>

    <!-- RIGHT COLUMN: Anti-Cheat Checks & Question Palette (4 cols on desktop) -->
    <div class="lg:col-span-4 space-y-5">

        <!-- 1. Anti-Cheat Live Checklist -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between">
                <p class="text-xs uppercase font-bold text-slate-500 tracking-wider">Anti-Cheat Checks</p>
                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> 0 Violations
                </span>
            </div>
            
            <div class="space-y-2.5 text-xs text-slate-600">
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50">
                    <span class="flex items-center gap-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Tab switching</span>
                    </span>
                    <span class="text-emerald-700 font-semibold text-[11px]">Not detected</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50">
                    <span class="flex items-center gap-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Window switching</span>
                    </span>
                    <span class="text-emerald-700 font-semibold text-[11px]">Not detected</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50">
                    <span class="flex items-center gap-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Full-screen exit</span>
                    </span>
                    <span class="text-emerald-700 font-semibold text-[11px]">Not detected</span>
                </div>
            </div>
        </div>

        <!-- 2. Question Navigator Palette (Desktop & Tablet) -->
        <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-3">
            <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">Question Navigator</span>
                <span class="text-[11px] text-slate-400">5 / 20 Answered</span>
            </div>

            <!-- Grid of 20 Question Pills -->
            <div class="grid grid-cols-5 gap-2 text-center text-xs font-bold">
                @for ($i = 1; $i <= 20; $i++)
                    @if ($i < 6)
                        <!-- Answered -->
                        <button type="button" class="py-2 rounded-xl bg-emerald-100/70 text-[#11422d] hover:bg-emerald-200 transition">
                            {{ $i }}
                        </button>
                    @elseif ($i === 6)
                        <!-- Current Active -->
                        <button type="button" class="py-2 rounded-xl bg-[#11422d] text-white ring-2 ring-emerald-600 shadow-xs">
                            {{ $i }}
                        </button>
                    @else
                        <!-- Unanswered -->
                        <button type="button" class="py-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                            {{ $i }}
                        </button>
                    @endif
                @endfor
            </div>

            <div class="pt-2 flex items-center justify-around text-[10px] text-slate-500 border-t border-slate-100">
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-100 border border-emerald-400"></span> Answered</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#11422d]"></span> Current</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-200"></span> Unanswered</span>
            </div>
        </div>

        <!-- 3. Interactive Demo Testing Triggers (For Thesis / Presentation Defense) -->
        <div class="p-4 bg-slate-200/60 rounded-2xl text-center space-y-2 border border-slate-300/50">
            <span class="text-[11px] text-slate-600 font-bold block uppercase tracking-wider">Presentation Demo Controls:</span>
            <div class="flex flex-col sm:flex-row lg:flex-col gap-2">
                <button type="button" onclick="openViolationModal()" class="w-full py-2 px-3 text-xs font-semibold bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-xl transition shadow-xs">
                    Preview Violation Warning (Screen 15)
                </button>
                <button type="button" onclick="openSubmitModal()" class="w-full py-2 px-3 text-xs font-semibold bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-xl transition shadow-xs">
                    Preview Submit Modal (Screen 19)
                </button>
            </div>
        </div>

    </div>

</div>

<!-- ============================================================ -->
<!-- MODAL 1: 15 - VIOLATION WARNING (IPHONE DESIGN ADAPTED)       -->
<!-- ============================================================ -->
<div id="violationModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center z-50 p-5 hidden">
    <div class="bg-white w-full max-w-sm rounded-3xl p-6 text-center shadow-2xl border border-slate-100 space-y-4 animate-in fade-in zoom-in duration-200">
        <!-- Warning Icon -->
        <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-500 mx-auto flex items-center justify-center text-xl font-bold">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <div>
            <h3 class="text-base font-extrabold text-slate-900">Violation detected</h3>
            <p class="text-xs text-slate-500 mt-1">You left the quiz window. This has been recorded.</p>
        </div>

        <!-- Violation Badge -->
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold">
            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
            Tab switching · 10:42 AM
        </div>

        <!-- 3-Segment Violation Progress Meter -->
        <div class="space-y-1.5 pt-1">
            <div class="flex items-center gap-2 justify-center">
                <div class="w-12 h-2 rounded-full bg-rose-500"></div>
                <div class="w-12 h-2 rounded-full bg-slate-100"></div>
                <div class="w-12 h-2 rounded-full bg-slate-100"></div>
            </div>
            <p class="text-xs font-bold text-rose-600">Violation 1 of 3</p>
        </div>

        <p class="text-[11px] text-slate-400">
            Your quiz is submitted automatically after 3 violations.
        </p>

        <button type="button" onclick="closeViolationModal()" class="w-full py-3 bg-[#11422d] hover:bg-[#0d3423] text-white font-bold text-xs rounded-xl transition shadow-xs">
            Return to Quiz
        </button>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL 2: 19 - SUBMIT CONFIRMATION (IPHONE DESIGN ADAPTED)     -->
<!-- ============================================================ -->
<div id="submitModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center z-50 p-5 hidden">
    <div class="bg-white w-full max-w-sm rounded-3xl p-6 text-center shadow-2xl border border-slate-100 space-y-4 animate-in fade-in zoom-in duration-200">
        <!-- Check Icon -->
        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 mx-auto flex items-center justify-center text-xl font-bold">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <div>
            <h3 class="text-base font-extrabold text-slate-900">Submit your quiz?</h3>
            <p class="text-xs text-slate-500 mt-1">You answered 19 of 20 questions. You can't change your answers after submitting.</p>
        </div>

        <!-- Badges -->
        <div class="flex items-center justify-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold border border-amber-200">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                Unanswered: 1
            </span>
            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-semibold border border-emerald-200">
                03:12 left
            </span>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <button type="button" onclick="closeSubmitModal()" class="flex-1 py-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs rounded-xl transition">
                Review answers
            </button>
            <a href="{{ route('student.submitted') }}" class="flex-1 py-3 bg-[#11422d] hover:bg-[#0d3423] text-white font-bold text-xs rounded-xl transition shadow-xs block text-center">
                Submit quiz
            </a>
        </div>
    </div>
</div>

<script>
    function openViolationModal() {
        document.getElementById('violationModal').classList.remove('hidden');
    }
    function closeViolationModal() {
        document.getElementById('violationModal').classList.add('hidden');
    }
    function openSubmitModal() {
        document.getElementById('submitModal').classList.remove('hidden');
    }
    function closeSubmitModal() {
        document.getElementById('submitModal').classList.add('hidden');
    }
</script>
@endsection
