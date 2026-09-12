<?php

namespace App\Http\Controllers;

use App\Models\OnlineExam;
use App\Models\OnlineExamAttempt;
use App\Models\OnlineExamQuestion;
use App\Models\QuestionBank;
use Illuminate\Http\Request;

class OnlineExamController extends OnlineExamCrudController
{
    public function index(Request $request)
    {
        $user = $request->user();
        $q = OnlineExam::with(['schoolClass', 'subject'])->latest();

        if ($user->role === 'student' && $user->student) {
            $q->where('status', 'published')
              ->where(function ($sub) use ($user) {
                  $sub->where('class_id', $user->student->class_id)->orWhereNull('class_id');
              });
        }

        $items = $q->paginate(15)->withQueryString();
        $attempts = $user->role === 'student' && $user->student
            ? OnlineExamAttempt::where('student_id', $user->student->id)->pluck('score', 'online_exam_id')
            : collect();

        return view('online-exam.index', ['items' => $items, 'attempts' => $attempts]);
    }

    /** Manage questions attached to an exam */
    public function questions($id)
    {
        $exam = OnlineExam::findOrFail($id);
        $attached = OnlineExamQuestion::where('online_exam_id', $id)->pluck('question_bank_id')->toArray();
        $bank = QuestionBank::orderBy('id', 'desc')
            ->when($exam->subject_id, fn ($q) => $q->where(function ($s) use ($exam) {
                $s->where('subject_id', $exam->subject_id)->orWhereNull('subject_id');
            }))->get();

        return view('online-exam.questions', ['exam' => $exam, 'bank' => $bank, 'attached' => $attached]);
    }

    public function questionsSave(Request $request, $id)
    {
        $exam = OnlineExam::findOrFail($id);
        OnlineExamQuestion::where('online_exam_id', $id)->delete();
        foreach ((array) $request->input('questions', []) as $qid) {
            OnlineExamQuestion::create(['online_exam_id' => $id, 'question_bank_id' => $qid]);
        }
        $exam->update(['total_mark' => QuestionBank::whereIn('id', (array) $request->input('questions', []))->sum('mark')]);
        return redirect()->route('online-exams.questions', $id)->with('success', 'Questions updated.');
    }

    /** Student: take the exam */
    public function take($id)
    {
        $exam = OnlineExam::with(['schoolClass', 'subject'])->findOrFail($id);
        abort_unless($exam->status === 'published', 403, 'This exam is not open.');

        $student = auth()->user()->student;
        abort_unless($student, 403);

        $already = OnlineExamAttempt::where('online_exam_id', $id)->where('student_id', $student->id)->first();
        if ($already) {
            return redirect()->route('online-exams.index')->with('error', 'You have already submitted this exam. Score: ' . $already->score);
        }

        $questions = QuestionBank::whereIn('id', OnlineExamQuestion::where('online_exam_id', $id)->pluck('question_bank_id'))->get();

        return view('online-exam.take', ['exam' => $exam, 'questions' => $questions]);
    }

    public function submit(Request $request, $id)
    {
        $exam = OnlineExam::findOrFail($id);
        $student = auth()->user()->student;
        abort_unless($student, 403);

        $existing = OnlineExamAttempt::where('online_exam_id', $id)->where('student_id', $student->id)->first();
        if ($existing) {
            return redirect()->route('online-exams.index')->with('error', 'Exam already submitted.');
        }

        $questions = QuestionBank::whereIn('id', OnlineExamQuestion::where('online_exam_id', $id)->pluck('question_bank_id'))->get();
        $answers = (array) $request->input('answers', []);
        $score = 0;

        foreach ($questions as $q) {
            $given = trim((string) ($answers[$q->id] ?? ''));
            $correct = trim((string) $q->correct_answer);
            if ($given !== '' && strcasecmp($given, $correct) === 0) {
                $score += $q->mark ?? 1;
            }
        }

        OnlineExamAttempt::create([
            'online_exam_id' => $id,
            'student_id'     => $student->id,
            'answers'        => json_encode($answers),
            'score'          => $score,
            'submitted_at'   => now(),
        ]);

        return redirect()->route('online-exams.index')->with('success', 'Exam submitted! Your score: ' . $score . ' / ' . ($exam->total_mark ?? $questions->sum('mark')));
    }
}
