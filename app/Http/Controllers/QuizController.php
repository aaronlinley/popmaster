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
        $fiveDaysAgo = Carbon::today()->subWeek();
        $quizzesThisWeek = Quiz::all()->where('created_at', '>=', $fiveDaysAgo->toDateTimeString())->count();
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
            'question_1' => $request->question_1_score,
            'question_2' => $request->question_2_score,
            'question_3' => $request->question_3_score,
            'question_4' => $request->question_4_score,
            'question_5' => $request->question_5_score,
            'question_6' => $request->question_6_score,
            'question_7' => $request->question_7_score,
            'question_8' => $request->question_8_score,
            'question_9' => $request->question_9_score,
            'question_10' => $request->question_10_score,
        ];
        foreach ( $scores as $question => $score ) {
            $quiz->total_points += $score;
        }
        $quiz->question_marks = json_encode($scores);
        $quiz->{'3_in_10'} = $request->three_in_ten;
        $quiz->save();
        if ( $quiz->total_points !== 0 ) {
            flash("Congrats! You got <strong>$quiz->total_points</strong> on your most recent quiz!")->success();
        } else {
            flash("Better luck next time!")->success();
        }
        return redirect('/');
    }
}
