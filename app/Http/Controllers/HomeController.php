<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quiz;
use Carbon\Carbon;

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
        if ( Quiz::all()->count() > 0 ) {
            $quizzes = Quiz::all()->sortByDesc('created_at');
            $mostRecent = $quizzes->first();

            $created = new Carbon($mostRecent->created_at);
            $now = Carbon::now();
            $difference = ($created->diff($now)->days < 1) ? 'today' : $created->diffForHumans($now);

            $highScore = Quiz::max('total_points');
            $highQuiz = $quizzes->where('total_points', $highScore)->first();

            $average = Quiz::avg('total_points');

            $variables = [
                'quizzes' => $quizzes,
                'averageScore' => $average,
                'bestQuiz' => $highQuiz,
                'mostRecentQuiz' => $mostRecent,
                'mostRecentQuizDifference' => $difference,
            ];
        }

        return view('home', $variables);
    }
}
