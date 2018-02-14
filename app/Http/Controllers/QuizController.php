<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quiz;
use Auth;

use Carbon\Carbon;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'auth.quiz']);
    }

    public function create()
    {
        $user = Auth::user();
        $fiveDaysAgo = Carbon::today()->subWeek();
        $quizzesThisWeek = $user->quizzes->where('created_at', '>=', $fiveDaysAgo->toDateTimeString())->count();
        if ( $quizzesThisWeek >= 5 ) {
            flash("You've already had your fill for this week!")->warning();
            return redirect('/');
        } else {
            $quiz = Quiz::create([
                'user_id' => Auth::id(),
            ]);
            return redirect(route('quiz.show', $quiz));
        }
    }

    public function show(Quiz $quiz)
    {
        return view('quiz.show', ['quiz' => $quiz]);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $scores = [
            'round_1' => [
                'question_1' => $request->round_1_question_1_score,
                'question_2' => $request->round_1_question_2_score,
                'question_3' => $request->round_1_question_3_score,
                'question_4' => $request->round_1_question_4_score,
                'question_5' => $request->round_1_question_5_score,
                'question_6' => $request->round_1_question_6_score,
                'question_7' => $request->round_1_question_7_score,
                'question_8' => $request->round_1_question_8_score,
                'question_9' => $request->round_1_question_9_score,
                'question_10' => $request->round_1_question_10_score,
            ],
            'round_2' => [
                'question_1' => $request->round_2_question_1_score,
                'question_2' => $request->round_2_question_2_score,
                'question_3' => $request->round_2_question_3_score,
                'question_4' => $request->round_2_question_4_score,
                'question_5' => $request->round_2_question_5_score,
                'question_6' => $request->round_2_question_6_score,
                'question_7' => $request->round_2_question_7_score,
                'question_8' => $request->round_2_question_8_score,
                'question_9' => $request->round_2_question_9_score,
                'question_10' => $request->round_2_question_10_score,
            ]
        ];

        $totalPoints = [];
        foreach ( $scores as $round => $roundScores ) {
            $totalPoints[$round] = 0;
            foreach ( $roundScores as $question => $score ) {
                $totalPoints[$round] += $score;
            }
        }
        $quiz->total_points = json_encode($totalPoints);
        $quiz->question_marks = json_encode($scores);
        $quiz->{'3_in_10'} = $request->three_in_ten;
        $quiz->save();
        flash("Congrats! You got <strong>".json_decode($quiz->total_points,true)['round_1']."</strong> on Round 1 & <strong>".json_decode($quiz->total_points,true)['round_2']."</strong> in Round 2!")->success();
        return redirect('/');
    }
}
