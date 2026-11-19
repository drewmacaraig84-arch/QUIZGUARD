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
    // library page: shows active banks
    public function index()
    {
        $banks = QuestionBank::with('subject')
            ->where('teacher_id', Auth::id())
            ->where('status', 'active')
            ->orderBy('uploaded_at', 'desc')
            ->get();

        $subjects = Subject::where('status', 'active')->get();

        return view('teacher.question_banks', ['banks' => $banks, 'subjects' => $subjects]);
    }

    // creates a new bank saves the questions found in the uploaded file
    public function store(Request $request)
    {
        // subject must exists
        // using mimes ot only accept Word, PDF or text files, max 5MB (5120 KB)
        $request->validate([
            'bank_title' => 'required|max:45',
            'subject_id' => 'required|exists:subjects,subject_id',
            'file'       => 'required|file|mimes:docx,pdf,txt|max:5120',
        ]);

        // 1 - any file to plain text
        // 2 - plain text to questions
        $text      = $this->extractText($request->file('file'));
        $questions = $this->readQuestions($text);

        // nothing readable (wrong format, scanned PDF, empty file)
        if (count($questions) === 0) {
            return back()->withErrors(['file' => 'No questions found. Check the template format.'])->withInput();
        }

        // check every question
        // tell the teacher exactly which one is wrong
        foreach ($questions as $i => $q) {
            $number = $i + 1;

            if ($q['text'] === '' || $q['answer'] === '') {
                return back()->withErrors(['file' => "Question $number is missing its text or answer."])->withInput();
            }

            // multiple choice: the answer must be one of the letters given
            if (count($q['options']) > 0 && !isset($q['options'][strtoupper($q['answer'])])) {
                return back()->withErrors(['file' => "Question $number: the answer must be one of the choices (A-D)."])->withInput();
            }
        }

        // transaction = the bank and its questions are saved together
        $bank = DB::transaction(function () use ($request, $questions) {
            $bank = QuestionBank::create([
                'teacher_id'       => Auth::id(),   // always the logged-in teacher
                'subject_id'       => $request->subject_id,
                'bank_title'       => $request->bank_title,
                // limit the length so a very long file name can't break the insert
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
                    // options are stored as JSON text
                    'options'         => $isChoice ? json_encode($q['options']) : null,
                    // multiple choice keeps the letter A
                    // identification keeps the answer text
                    'correct_answers' => $isChoice ? strtoupper($q['answer']) : $q['answer'],
                    'points'          => max(1, $q['points']),   // at least 1 point
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

    // soft delete set status to inactive, the row stays in the database
    public function archive($id)
    {
        // teacher can't archive another teacher's bank
        $bank = QuestionBank::where('bank_id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $bank->update(['status' => 'inactive']);

        ActivityLog::record(Auth::user()->school_id_num, Auth::user()->role, 'BANK_DEACTIVATED', 'Deactivated question bank: ' . $bank->bank_title);

        return redirect('/teacher/question-banks')->with('success', 'Question bank deactivated.');
    }

    // turns an uploaded word, pdf or text file into plain text
    private function extractText($file)
    {
        $path = $file->getRealPath();
        $ext  = strtolower($file->getClientOriginalExtension());

        // for txt file
        if ($ext === 'txt') {
            return (string) file_get_contents($path);
        }

        // for word file
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

            // end of each paragraph becomes a new line
            // remove all XML tags
            $xml = str_replace('</w:p>', "\n", $xml);
            return html_entity_decode(strip_tags($xml));
        }

        // for pdf file use the smalot/pdfparser package (installed using the command composer require smalot/pdfparser)
        if ($ext === 'pdf') {
            try {
                $parser = new \Smalot\PdfParser\Parser();
                return $parser->parseFile($path)->getText();
            } catch (\Exception $e) {
                return '';   // unreadable or scanned PDF return error
            }
        }

        return '';
    }

    // turns plain text into an array of questions
    private function readQuestions($text)
    {
        // make all line endings the same
        $text = str_replace(["\r\n", "\r"], "\n", $text);

        $questions = [];
        $current   = null;   // the question being built

        foreach (explode("\n", $text) as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            if (stripos($line, 'Q:') === 0) {
                // a new question starts
                // save the previous one first
                if ($current) {
                    $questions[] = $current;
                }
                $current = ['text' => trim(substr($line, 2)), 'options' => [], 'answer' => '', 'points' => 1];
            }

            elseif ($current && preg_match('/^([A-D])[.)]\s*(.+)$/i', $line, $m)) {
                $current['options'][strtoupper($m[1])] = $m[2];
            }

            elseif ($current && stripos($line, 'ANSWER:') === 0) {
                $current['answer'] = trim(substr($line, 7));
            }

            elseif ($current && stripos($line, 'POINTS:') === 0) {
                $current['points'] = (int) trim(substr($line, 7));
            }

            elseif ($current && $current['answer'] === '') {
                if (count($current['options']) > 0) {
                    $keys = array_keys($current['options']);
                    $last = end($keys);
                    $current['options'][$last] .= ' ' . $line;   // continues the last choice
                } else {
                    $current['text'] .= ' ' . $line;             // continues the question text
                }
            }
        }

        // don't forget the last question
        if ($current) {
            $questions[] = $current;
        }

        return $questions;
    }
}
