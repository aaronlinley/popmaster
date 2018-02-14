<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quiz;
use Carbon\Carbon;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variables = [];
        $user = Auth::user();
        if ( $user->quizzes->count() > 0 ) {
            $quizzes = $user->quizzes->sortByDesc('created_at');
            $mostRecent = $quizzes->first();

            $created = new Carbon($mostRecent->created_at);
            $now = Carbon::now();
            $difference = ($created->diff($now)->days < 1) ? 'today' : $created->diffForHumans($now);

            $allScores = [];
            foreach ( $quizzes as $quiz ) {
                $totalPoints = json_decode( $quiz->total_points, true );
                $allScores[$quiz->id.'_round_1'] = $totalPoints['round_1'];
                $allScores[$quiz->id.'_round_2'] = $totalPoints['round_2'];
            }

            $highScore = max($allScores);
            $highScoreQuizId = array_search($highScore, $allScores);
            $highQuiz = $quizzes->where('id', $highScoreQuizId)->first();

            $average = array_sum($allScores) / count($allScores);

            $variables = [
                'quizzes' => $quizzes,
                'averageScore' => $average,
                'bestQuiz' => $highQuiz,
                'highScore' => $highScore,
                'mostRecentQuiz' => $mostRecent,
                'mostRecentQuizDifference' => $difference,
            ];
        }

        return view('home', $variables);
    }
}
