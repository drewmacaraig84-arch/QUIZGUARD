<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Question;
use App\Models\QuestionBank;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionBankController extends Controller
{
    // Library page: shows active banks owned by the logged-in teacher
    public function index()
    {
        $banks = QuestionBank::with('subject')
            ->withCount(['questions' => fn($q) => $q->where('status', 'active')])
            ->where('teacher_id', Auth::id())
            ->orderByRaw("CASE WHEN status = 'active' THEN 0 ELSE 1 END")
            ->orderBy('uploaded_at', 'desc')
            ->get();

        $subjects = Subject::where('status', 'active')->get();

        return view('teacher.question_banks', [
            'banks'    => $banks,
            'subjects' => $subjects,
        ]);
    }

    // Shows the questions inside one bank
    public function show($id)
    {
        $bank = QuestionBank::with('subject')
            ->where('bank_id', $id)
            ->where('teacher_id', Auth::id())
            ->where('status', 'active')
            ->firstOrFail();

        $questions = Question::where('bank_id', $bank->bank_id)
            ->where('status', 'active')
            ->orderBy('question_id')
            ->get();

        return view('teacher.bank_questions', [
            'bank'      => $bank,
            'questions' => $questions,
        ]);
    }

    // Creates a new bank and saves the questions parsed from the uploaded file
    public function store(Request $request)
    {
        $request->validate([
            'bank_title' => 'required|string|max:45',
            'subject_id' => 'required|exists:subjects,subject_id',
            'file'       => 'required|file|mimes:docx,pdf,txt|max:5120',
        ]);

        $text      = $this->extractText($request->file('file'));
        $questions = $this->readQuestions($text);

        if (count($questions) === 0) {
            return back()
                ->withErrors(['file' => 'No questions found. Check the template format (Q:, A.-D., ANSWER:).'])
                ->withInput();
        }

        foreach ($questions as $i => $q) {
            $number = $i + 1;

            if ($q['text'] === '' || $q['answer'] === '') {
                return back()
                    ->withErrors(['file' => "Question $number is missing its text or answer."])
                    ->withInput();
            }

            if (count($q['options']) > 0 && !isset($q['options'][strtoupper($q['answer'])])) {
                return back()
                    ->withErrors(['file' => "Question $number: the answer must be one of the choices (A-D)."])
                    ->withInput();
            }
        }

        $bank = DB::transaction(function () use ($request, $questions) {
            $bank = QuestionBank::create([
                'teacher_id'       => Auth::id(),
                'subject_id'       => $request->subject_id,
                'bank_title'       => $request->bank_title,
                'source_file_name' => Str::limit($request->file('file')->getClientOriginalName(), 100, ''),
                'uploaded_at'      => now(),
                'status'           => 'active',
            ]);

            foreach ($questions as $q) {
                $isChoice = count($q['options']) > 0;

                Question::create([
                    'bank_id'         => $bank->bank_id,
                    'question_text'   => $q['text'],
                    'question_type'   => $isChoice ? 'multiple_choice' : 'identification',
                    'options'         => $isChoice ? json_encode($q['options']) : null,
                    'correct_answers' => $isChoice ? strtoupper($q['answer']) : $q['answer'],
                    'points'          => max(1, $q['points']),
                    'status'          => 'active',
                ]);
            }

            return $bank;
        });

        ActivityLog::record(
            Auth::user()->school_id_num,
            Auth::user()->role,
            'BANK_CREATED',
            'Created question bank: ' . $bank->bank_title . ' (' . count($questions) . ' questions)'
        );

        return redirect('/teacher/question-banks')->with('success', count($questions) . ' questions imported.');
    }

    // Soft delete: set status to inactive
    public function archive($id)
    {
        $bank = QuestionBank::where('bank_id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $bank->update(['status' => 'inactive']);

        ActivityLog::record(
            Auth::user()->school_id_num,
            Auth::user()->role,
            'BANK_DEACTIVATED',
            'Deactivated question bank: ' . $bank->bank_title
        );

        return redirect('/teacher/question-banks')->with('success', 'Question bank deactivated.');
    }

    public function activate($id)
    {
        $bank = QuestionBank::where('bank_id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $bank->update(['status' => 'active']);

        ActivityLog::record(
            Auth::user()->school_id_num,
            Auth::user()->role,
            'BANK_ACTIVATED',
            'Activated question bank: ' . $bank->bank_title
        );

        return redirect('/teacher/question-banks')->with('success', 'Question bank activated.');
    }

    private function extractText($file)
    {
        $path = $file->getRealPath();
        $ext  = strtolower($file->getClientOriginalExtension());

        if ($ext === 'txt') {
            return (string) file_get_contents($path);
        }

        if ($ext === 'docx') {
            $zip = new \ZipArchive();
            if ($zip->open($path) !== true) {
                return '';
            }
            $xml = $zip->getFromName('word/document.xml');
            $zip->close();

            if ($xml === false) {
                return '';
            }

            $xml = str_replace('</w:p>', "\n", $xml);
            return html_entity_decode(strip_tags($xml));
        }

        if ($ext === 'pdf') {
            try {
                $parser = new \Smalot\PdfParser\Parser();
                return $parser->parseFile($path)->getText();
            } catch (\Exception $e) {
                return '';
            }
        }

        return '';
    }

    private function readQuestions($text)
    {
        $text      = str_replace(["\r\n", "\r"], "\n", $text);
        $questions = [];
        $current   = null;

        foreach (explode("\n", $text) as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            if (stripos($line, 'Q:') === 0) {
                if ($current) {
                    $questions[] = $current;
                }
                $current = ['text' => trim(substr($line, 2)), 'options' => [], 'answer' => '', 'points' => 1];
            } elseif ($current && preg_match('/^([A-D])[.)]\s*(.+)$/i', $line, $m)) {
                $current['options'][strtoupper($m[1])] = $m[2];
            } elseif ($current && stripos($line, 'ANSWER:') === 0) {
                $current['answer'] = trim(substr($line, 7));
            } elseif ($current && stripos($line, 'POINTS:') === 0) {
                $current['points'] = (int) trim(substr($line, 7));
            } elseif ($current && $current['answer'] === '') {
                if (count($current['options']) > 0) {
                    $keys = array_keys($current['options']);
                    $last = end($keys);
                    $current['options'][$last] .= ' ' . $line;
                } else {
                    $current['text'] .= ' ' . $line;
                }
            }
        }

        if ($current) {
            $questions[] = $current;
        }

        return $questions;
    }
}
