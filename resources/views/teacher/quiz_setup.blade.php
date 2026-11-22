@extends('layouts.teacher')

@section('title', 'Quiz Setup')

@section('content')
    @php
        $fresh = old('title') === null;
        $initialMode = old('creation_mode', 'manual');

        // Prepare bank data + questions as JSON for instant live preview
        $bankPayload = $banks
            ->map(function ($b) {
                return [
                    'bank_id' => $b->bank_id,
                    'title' => $b->bank_title,
                    'subject' => $b->subject ? $b->subject->subject_code . ' - ' . $b->subject->subject_name : 'N/A',
                    'questions' => $b->questions
                        ->map(function ($q) {
                            return [
                                'question_id' => $q->question_id,
                                'question_text' => $q->question_text,
                                'question_type' => $q->question_type,
                                'options' => $q->options ? json_decode($q->options, true) : null,
                                'correct_answers' => $q->correct_answers,
                                'points' => $q->points,
                            ];
                        })
                        ->values(),
                ];
            })
            ->keyBy('bank_id');

        $oldQuestions = old('questions');
    @endphp

    <form method="POST" action="/teacher/quizzes" id="quizSetupForm">
        @csrf
        <input type="hidden" name="creation_mode" id="creationModeInput" value="{{ $initialMode }}">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <p class="text-xs text-slate-400">Quizzes / Setup</p>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Quiz Setup</h1>
                <p class="text-xs text-slate-500 mt-1">Build questions from scratch or pick an existing question bank with
                    live preview.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/teacher/quizzes"
                    class="px-4 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-medium transition">
                    Cancel
                </a>
                <button type="submit" @disabled($sections->isEmpty())
                    class="px-5 py-2 bg-[#11422d] hover:bg-[#0d3423] disabled:opacity-50 text-white rounded-xl text-xs font-semibold transition shadow-xs">
                    ✓ Publish Quiz
                </button>
            </div>
        </div>

        <!-- Mode Switcher -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <button type="button" data-mode="manual"
                class="mode-btn text-left p-4 rounded-2xl border-2 transition bg-white shadow-xs">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-bold text-slate-900">Build Questions from Scratch</span>
                    <span class="mode-badge text-[10px] font-semibold px-2.5 py-0.5 rounded-full">Manual</span>
                </div>
                <p class="text-xs text-slate-500 mt-1">Add Multiple Choice or Identification questions directly right
                    here—no question bank needed.</p>
            </button>

            <button type="button" data-mode="bank"
                class="mode-btn text-left p-4 rounded-2xl border-2 transition bg-white shadow-xs">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-bold text-slate-900">Use an Existing Question Bank</span>
                    <span class="mode-badge text-[10px] font-semibold px-2.5 py-0.5 rounded-full">With Preview</span>
                </div>
                <p class="text-xs text-slate-500 mt-1">Pick one of your uploaded banks and preview how the quiz questions
                    will be set up.</p>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- LEFT COLUMN (2/3): Details + Questions / Bank Preview -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Quiz Details Card -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6 space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Quiz Details</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Quiz Title</label>
                            <input type="text" name="title" id="quizTitleInput" maxlength="45" required
                                value="{{ old('title') }}" placeholder="e.g. Midterm Review Quiz"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Section</label>
                            @if ($sections->isEmpty())
                                <p class="text-xs text-rose-600 py-2">No active student sections found. Ask the admin to add
                                    students first.</p>
                            @else
                                <select name="section" required
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section }}"
                                            {{ old('section') === $section ? 'selected' : '' }}>{{ $section }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>

                    <!-- Manual Mode: Subject Picker -->
                    <div id="manualMetaRow" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Subject</label>
                            @if ($subjects->isEmpty())
                                <p class="text-xs text-rose-600 py-2">No active subjects found. Ask the admin to add one.
                                </p>
                            @else
                                <select name="subject_id" id="manualSubjectSelect"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->subject_id }}"
                                            {{ old('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                                            {{ $subject->subject_code }} - {{ $subject->subject_name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Questions Added</label>
                            <div id="manualCountBadge"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700 font-medium">
                                0 questions (0 pts total)
                            </div>
                        </div>
                    </div>

                    <!-- Bank Mode: Bank Picker + Number of Questions -->
                    <div id="bankMetaRow" class="grid grid-cols-1 sm:grid-cols-2 gap-4 hidden">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Question Bank</label>
                            @if ($banks->isEmpty())
                                <div
                                    class="text-xs text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2">
                                    No banks uploaded yet. <a href="/teacher/question-banks"
                                        class="underline font-semibold">Upload one</a> or switch to "Build from Scratch".
                                </div>
                            @else
                                <select name="bank_id" id="bankSelect"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->bank_id }}"
                                            {{ old('bank_id') == $bank->bank_id ? 'selected' : '' }}>
                                            {{ $bank->bank_title }} ({{ $bank->questions->count() }} items)
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Number of Questions to
                                Pull</label>
                            <input type="number" min="1" name="number_of_questions" id="bankQuestionCountInput"
                                value="{{ old('number_of_questions', 10) }}"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Time Limit (min)</label>
                            <input type="number" min="1" required name="time_limit_min" id="timeLimitInput"
                                value="{{ old('time_limit_min', 30) }}"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Passing Score (%)</label>
                            <input type="number" min="0" max="100" required name="passing_score"
                                id="passingScoreInput" value="{{ old('passing_score', 75) }}"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Attempts Allowed</label>
                            <input type="number" min="1" required name="attempts_allowed"
                                value="{{ old('attempts_allowed', 1) }}"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Grading Method</label>
                            <select name="grading_method" required
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                                <option value="highest" {{ old('grading_method') === 'highest' ? 'selected' : '' }}>
                                    Highest score</option>
                                <option value="latest" {{ old('grading_method') === 'latest' ? 'selected' : '' }}>Latest
                                    score</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Opens At</label>
                            <input type="datetime-local" required name="open_at" value="{{ old('open_at') }}"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Closes At</label>
                            <input type="datetime-local" required name="closed_at" value="{{ old('closed_at') }}"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        </div>
                    </div>
                </div>

                <!-- MANUAL MODE: Wayground-style Inline Question Builder -->
                <div id="manualBuilderSection" class="space-y-4">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <h2 class="text-base font-bold text-slate-900">Questions</h2>
                            <p class="text-xs text-slate-500">Add and configure each question directly below.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" id="addMcBtn"
                                class="px-3.5 py-2 bg-[#11422d] hover:bg-[#0d3423] text-white rounded-xl text-xs font-medium transition">
                                + Multiple Choice
                            </button>
                            <button type="button" id="addIdBtn"
                                class="px-3.5 py-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-medium transition">
                                + Identification
                            </button>
                        </div>
                    </div>

                    <div id="questionsContainer" class="space-y-4"></div>
                </div>

                <!-- BANK MODE: Live Quiz Setup Preview -->
                <div id="bankPreviewSection" class="hidden space-y-4">
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-4 mb-4">
                            <div>
                                <h2 class="text-base font-bold text-slate-900">Quiz Setup Preview</h2>
                                <p id="previewSubtitle" class="text-xs text-slate-500 mt-0.5">Select a question bank to
                                    preview how the quiz will be set up.</p>
                            </div>
                            <span id="previewOrderTag"
                                class="self-start sm:self-auto px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Shuffled Questions & Choices
                            </span>
                        </div>

                        <div id="previewQuestionsList" class="space-y-3 max-h-[540px] overflow-y-auto pr-1"></div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN (1/3): Randomization, Anti-Cheat, Live Setup Summary -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6 space-y-3">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Randomization</h2>
                    <label class="flex items-center gap-2 text-xs text-slate-700">
                        <input type="checkbox" name="shuffle_questions" id="shuffleQuestionsInput" value="1"
                            {{ $fresh || old('shuffle_questions') ? 'checked' : '' }}>
                        Shuffle questions
                    </label>
                    <label class="flex items-center gap-2 text-xs text-slate-700">
                        <input type="checkbox" name="shuffle_answers" id="shuffleAnswersInput" value="1"
                            {{ $fresh || old('shuffle_answers') ? 'checked' : '' }}>
                        Shuffle choices
                    </label>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs p-6 space-y-3">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Anti-Cheat Settings</h2>
                    <p class="text-[11px] text-slate-500">Enforced automatically on every quiz:</p>
                    <label class="flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" checked disabled>
                        Detect tab switching</label>
                    <label class="flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" checked disabled>
                        Detect window switching</label>
                    <label class="flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" checked disabled>
                        Detect exit from full-screen</label>
                    <label class="flex items-center gap-2 text-xs text-slate-600"><input type="checkbox" checked disabled>
                        Detect third-party app / copy-paste</label>

                    <div class="pt-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Allowed Violations</label>
                        <input type="number" min="1" required name="max_violation" id="maxViolationInput"
                            value="{{ old('max_violation', 3) }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">
                        <p class="text-[11px] text-slate-400 mt-1">Auto-submits the quiz when this limit is reached.</p>
                    </div>
                </div>

                <div class="bg-[#11422d] text-white rounded-2xl p-6 space-y-2 shadow-xs">
                    <p class="text-[10px] uppercase tracking-wider text-emerald-200/70 font-bold">Live Setup Summary</p>
                    <p id="summaryTitle" class="text-base font-bold truncate">Untitled Quiz</p>
                    <ul id="summaryList" class="text-xs text-emerald-100/90 space-y-1 pt-1"></ul>
                </div>
            </div>
        </div>
    </form>

    <script>
        (function() {
            const banks = @json($bankPayload);
            const oldQuestions = @json($oldQuestions);

            const modeInput = document.getElementById('creationModeInput');
            const modeButtons = document.querySelectorAll('.mode-btn');

            const manualMetaRow = document.getElementById('manualMetaRow');
            const bankMetaRow = document.getElementById('bankMetaRow');
            const manualBuilderSection = document.getElementById('manualBuilderSection');
            const bankPreviewSection = document.getElementById('bankPreviewSection');

            const manualSubjectSelect = document.getElementById('manualSubjectSelect');
            const bankSelect = document.getElementById('bankSelect');
            const bankCountInput = document.getElementById('bankQuestionCountInput');

            const questionsContainer = document.getElementById('questionsContainer');
            const manualCountBadge = document.getElementById('manualCountBadge');

            const previewSubtitle = document.getElementById('previewSubtitle');
            const previewOrderTag = document.getElementById('previewOrderTag');
            const previewList = document.getElementById('previewQuestionsList');

            const titleInput = document.getElementById('quizTitleInput');
            const timeLimitInput = document.getElementById('timeLimitInput');
            const passingScoreInput = document.getElementById('passingScoreInput');
            const maxViolationInput = document.getElementById('maxViolationInput');
            const shuffleQuestionsInput = document.getElementById('shuffleQuestionsInput');
            const shuffleAnswersInput = document.getElementById('shuffleAnswersInput');

            const summaryTitle = document.getElementById('summaryTitle');
            const summaryList = document.getElementById('summaryList');

            let questionUid = 0;

            function escapeHtml(str) {
                return String(str ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;');
            }

            function setMode(mode) {
                modeInput.value = mode;
                const isManual = mode === 'manual';

                modeButtons.forEach(btn => {
                    const active = btn.dataset.mode === mode;
                    btn.classList.toggle('border-[#11422d]', active);
                    btn.classList.toggle('bg-emerald-50/30', active);
                    btn.classList.toggle('border-slate-200', !active);
                    const badge = btn.querySelector('.mode-badge');
                    badge.classList.toggle('bg-[#11422d]', active);
                    badge.classList.toggle('text-white', active);
                    badge.classList.toggle('bg-slate-100', !active);
                    badge.classList.toggle('text-slate-600', !active);
                });

                manualMetaRow.classList.toggle('hidden', !isManual);
                manualBuilderSection.classList.toggle('hidden', !isManual);
                bankMetaRow.classList.toggle('hidden', isManual);
                bankPreviewSection.classList.toggle('hidden', isManual);

                // Toggle required/disabled so hidden mode inputs don't block browser form submit
                if (manualSubjectSelect) manualSubjectSelect.disabled = !isManual;
                if (bankSelect) bankSelect.disabled = isManual;
                if (bankCountInput) {
                    bankCountInput.disabled = isManual;
                    bankCountInput.required = !isManual;
                }
                questionsContainer.querySelectorAll('input, textarea, select').forEach(el => {
                    el.disabled = !isManual;
                });

                if (!isManual) renderBankPreview();
                updateSummary();
            }

            function addQuestionCard(data = {}) {
                const idx = questionUid++;
                const type = data.type || 'multiple_choice';
                const points = data.points || 1;
                const text = data.text || '';
                const options = data.options || {
                    A: '',
                    B: '',
                    C: '',
                    D: ''
                };
                const correct = data.correct_answer || (type === 'multiple_choice' ? 'A' : '');

                const card = document.createElement('div');
                card.className = 'question-card bg-white rounded-2xl border border-slate-100 shadow-xs p-5 space-y-4';
                card.innerHTML = `
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-3">
                <div class="flex items-center gap-3">
                    <span class="q-number px-2.5 py-1 rounded-lg bg-[#11422d] text-white text-xs font-bold">Q</span>
                    <select name="questions[${idx}][type]" class="q-type border border-slate-200 rounded-lg px-2.5 py-1.5 text-xs font-medium">
                        <option value="multiple_choice" ${type === 'multiple_choice' ? 'selected' : ''}>Multiple Choice</option>
                        <option value="identification" ${type === 'identification' ? 'selected' : ''}>Identification</option>
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-xs text-slate-500">Points:</label>
                    <input type="number" min="1" required name="questions[${idx}][points]" value="${points}"
                        class="q-points w-16 border border-slate-200 rounded-lg px-2 py-1 text-xs text-center">
                    <button type="button" class="q-dup px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-50 text-xs text-slate-600">Duplicate</button>
                    <button type="button" class="q-del px-2.5 py-1 rounded-lg border border-rose-200 hover:bg-rose-50 text-xs text-rose-600">Remove</button>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Question Prompt</label>
                <textarea name="questions[${idx}][text]" rows="2" required placeholder="Type your question here..."
                    class="q-text w-full border border-slate-200 rounded-lg px-3 py-2 text-xs">${escapeHtml(text)}</textarea>
            </div>

            <div class="mc-box ${type === 'multiple_choice' ? '' : 'hidden'} space-y-2">
                <p class="text-[11px] font-semibold text-slate-500">Answer Choices (select the correct answer)</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    ${['A', 'B', 'C', 'D'].map(letter => `
                            <label class="mc-row flex items-center gap-2 p-2 rounded-xl border ${correct === letter ? 'border-emerald-400 bg-emerald-50/50' : 'border-slate-200'}">
                                <input type="radio" class="mc-radio" name="questions[${idx}][correct_radio]" value="${letter}" ${correct === letter ? 'checked' : ''}>
                                <span class="text-xs font-bold text-slate-600 w-4">${letter}.</span>
                                <input type="text" name="questions[${idx}][options][${letter}]" value="${escapeHtml(options[letter] || '')}"
                                    placeholder="Choice ${letter}${letter === 'C' || letter === 'D' ? ' (optional)' : ''}"
                                    class="mc-opt flex-1 bg-transparent text-xs focus:outline-none">
                            </label>
                        `).join('')}
                </div>
            </div>

            <div class="id-box ${type === 'identification' ? '' : 'hidden'}">
                <label class="block text-xs font-semibold text-slate-700 mb-1">Exact Correct Answer</label>
                <input type="text" class="id-answer w-full border border-slate-200 rounded-lg px-3 py-2 text-xs"
                    value="${type === 'identification' ? escapeHtml(correct) : ''}" placeholder="e.g. HTTPS">
            </div>

            <input type="hidden" name="questions[${idx}][correct_answer]" class="q-correct-hidden" value="${escapeHtml(correct)}">
        `;

                const typeSel = card.querySelector('.q-type');
                const mcBox = card.querySelector('.mc-box');
                const idBox = card.querySelector('.id-box');
                const hiddenCorrect = card.querySelector('.q-correct-hidden');
                const idInput = card.querySelector('.id-answer');

                function syncCorrectAnswer() {
                    if (typeSel.value === 'multiple_choice') {
                        const checked = card.querySelector('.mc-radio:checked');
                        hiddenCorrect.value = checked ? checked.value : 'A';
                        card.querySelectorAll('.mc-row').forEach(row => {
                            const isSelected = row.querySelector('.mc-radio').checked;
                            row.classList.toggle('border-emerald-400', isSelected);
                            row.classList.toggle('bg-emerald-50/50', isSelected);
                            row.classList.toggle('border-slate-200', !isSelected);
                        });
                    } else {
                        hiddenCorrect.value = idInput.value;
                    }
                }

                typeSel.addEventListener('change', () => {
                    const isMc = typeSel.value === 'multiple_choice';
                    mcBox.classList.toggle('hidden', !isMc);
                    idBox.classList.toggle('hidden', isMc);
                    syncCorrectAnswer();
                });

                card.querySelectorAll('.mc-radio').forEach(r => r.addEventListener('change', syncCorrectAnswer));
                idInput.addEventListener('input', syncCorrectAnswer);
                card.querySelector('.q-points').addEventListener('input', renumberManual);

                card.querySelector('.q-dup').addEventListener('click', () => {
                    const optVals = {};
                    card.querySelectorAll('.mc-opt').forEach((inp, i) => {
                        optVals[['A', 'B', 'C', 'D'][i]] = inp.value;
                    });
                    addQuestionCard({
                        type: typeSel.value,
                        points: card.querySelector('.q-points').value,
                        text: card.querySelector('.q-text').value,
                        options: optVals,
                        correct_answer: hiddenCorrect.value,
                    });
                });

                card.querySelector('.q-del').addEventListener('click', () => {
                    if (questionsContainer.children.length <= 1) return;
                    card.remove();
                    renumberManual();
                });

                questionsContainer.appendChild(card);
                syncCorrectAnswer();
                renumberManual();
            }

            function renumberManual() {
                const cards = questionsContainer.querySelectorAll('.question-card');
                let totalPts = 0;
                cards.forEach((c, i) => {
                    c.querySelector('.q-number').textContent = `Q${i + 1}`;
                    c.querySelector('.q-del').disabled = cards.length <= 1;
                    totalPts += parseInt(c.querySelector('.q-points').value || '1', 10);
                });
                manualCountBadge.textContent =
                    `${cards.length} question${cards.length === 1 ? '' : 's'} (${totalPts} pts total)`;
                updateSummary();
            }

            function renderBankPreview() {
                const bankId = bankSelect ? bankSelect.value : null;
                const bank = bankId ? banks[bankId] : null;

                if (!bank) {
                    previewSubtitle.textContent = 'No question bank available.';
                    previewList.innerHTML =
                        '<p class="text-xs text-slate-400 text-center py-8">Upload a question bank first or switch to "Build Questions from Scratch".</p>';
                    return;
                }

                const total = bank.questions.length;
                const requested = Math.min(total, Math.max(1, parseInt(bankCountInput?.value || total, 10)));
                if (bankCountInput) {
                    bankCountInput.max = Math.max(1, total);
                }

                previewSubtitle.textContent =
                    `${bank.title} (${bank.subject}) — pulling ${requested} of ${total} questions`;

                const shufQ = shuffleQuestionsInput.checked;
                const shufA = shuffleAnswersInput.checked;
                previewOrderTag.textContent =
                    `${shufQ ? 'Shuffled questions' : 'Original order'} • ${shufA ? 'Shuffled choices' : 'Fixed choices'}`;

                if (total === 0) {
                    previewList.innerHTML =
                        '<p class="text-xs text-slate-400 text-center py-8">This bank has no active questions.</p>';
                    return;
                }

                previewList.innerHTML = bank.questions.map((q, idx) => {
                    const isMc = q.question_type === 'multiple_choice';
                    const included = idx < requested;
                    let bodyHtml = '';

                    if (isMc && q.options) {
                        bodyHtml = `<div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">` +
                            Object.entries(q.options).map(([letter, text]) => {
                                const isCorrect = letter.toUpperCase() === String(q.correct_answers)
                                    .toUpperCase();
                                return `<div class="px-3 py-1.5 rounded-lg text-xs border ${isCorrect ? 'bg-emerald-50 border-emerald-300 text-emerald-800 font-semibold' : 'bg-slate-50 border-slate-200 text-slate-600'}">
                            ${escapeHtml(letter)}. ${escapeHtml(text)} ${isCorrect ? '✓' : ''}
                        </div>`;
                            }).join('') + `</div>`;
                    } else {
                        bodyHtml = `<p class="mt-2 text-xs text-emerald-700 bg-emerald-50 border border-emerald-200 inline-block px-2.5 py-1 rounded-lg font-medium">
                    Answer: ${escapeHtml(q.correct_answers)}
                </p>`;
                    }

                    return `
                <div class="p-4 rounded-xl border ${included ? 'border-slate-200 bg-white' : 'border-dashed border-slate-200 bg-slate-50/70 opacity-60'}">
                    <div class="flex items-center justify-between gap-2 mb-1.5">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-slate-900">#${idx + 1}</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-600">
                                ${isMc ? 'Multiple Choice' : 'Identification'}
                            </span>
                            ${!shufQ && !included ? '<span class="text-[10px] text-slate-400">(outside selected count)</span>' : ''}
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500">${q.points} pt${q.points > 1 ? 's' : ''}</span>
                    </div>
                    <p class="text-xs font-medium text-slate-800">${escapeHtml(q.question_text)}</p>
                    ${bodyHtml}
                </div>
            `;
                }).join('');

                updateSummary();
            }

            function updateSummary() {
                const isManual = modeInput.value === 'manual';
                summaryTitle.textContent = titleInput.value.trim() || 'Untitled Quiz';

                let itemLabel = '';
                if (isManual) {
                    itemLabel = manualCountBadge.textContent;
                } else {
                    const bank = bankSelect ? banks[bankSelect.value] : null;
                    const total = bank ? bank.questions.length : 0;
                    const requested = bankCountInput ? Math.min(total, parseInt(bankCountInput.value || '0', 10)) : 0;
                    itemLabel = bank ? `${requested} of ${total} questions from "${bank.title}"` : 'No bank selected';
                }

                summaryList.innerHTML = `
            <li>• Mode: <strong>${isManual ? 'Build from Scratch' : 'Question Bank'}</strong></li>
            <li>• Items: <strong>${escapeHtml(itemLabel)}</strong></li>
            <li>• Time limit: <strong>${escapeHtml(timeLimitInput.value || 0)} min</strong></li>
            <li>• Passing score: <strong>${escapeHtml(passingScoreInput.value || 0)}%</strong></li>
            <li>• Max violations: <strong>${escapeHtml(maxViolationInput.value || 1)}</strong> (auto-submits)</li>
        `;
            }

            // Event bindings
            modeButtons.forEach(btn => btn.addEventListener('click', () => setMode(btn.dataset.mode)));
            document.getElementById('addMcBtn').addEventListener('click', () => addQuestionCard({
                type: 'multiple_choice'
            }));
            document.getElementById('addIdBtn').addEventListener('click', () => addQuestionCard({
                type: 'identification'
            }));

            [titleInput, timeLimitInput, passingScoreInput, maxViolationInput].forEach(el => {
                el?.addEventListener('input', updateSummary);
            });
            [bankSelect, bankCountInput, shuffleQuestionsInput, shuffleAnswersInput].forEach(el => {
                el?.addEventListener('input', renderBankPreview);
                el?.addEventListener('change', renderBankPreview);
            });

            // Hydrate initial questions
            if (Array.isArray(oldQuestions) && oldQuestions.length > 0) {
                oldQuestions.forEach(q => addQuestionCard(q));
            } else if (oldQuestions && typeof oldQuestions === 'object') {
                Object.values(oldQuestions).forEach(q => addQuestionCard(q));
            } else {
                addQuestionCard({
                    type: 'multiple_choice'
                });
            }

            setMode(modeInput.value || 'manual');
        })();
    </script>
@endsection
