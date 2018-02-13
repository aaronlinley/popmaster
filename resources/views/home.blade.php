@extends('layouts.app')

@section('content')
<div class="container">
    @if( isset($averageScore) && isset($bestQuiz) && isset($mostRecentQuiz) )
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">Your Average Score</h2>
                </div>
                <div class="panel-body text-center">
                    <span class="lead">{{ number_format($averageScore, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">Your Highest Ever Score</h2>
                </div>
                <div class="panel-body text-center">
                    <span class="lead">{{ $bestQuiz->total_points }}</span>
                    <br/>
                    <small class="text-muted">on {{ $bestQuiz->created_at->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">Your Most Recent Score</h2>
                </div>
                <div class="panel-body text-center">
                    <span class="lead">{{ $mostRecentQuiz->total_points }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="{{ route('quiz.create') }}" class="btn btn-primary btn-lg btn-block">Start New Quiz</a>
        </div>
    </div>

    @isset ( $quizzes )
    <h2>Past Quizzes</h2>
    <div class="row">
        @foreach ( $quizzes as $quiz )
            @if ( $quiz->question_marks )
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title text-center">
                                {{ $quiz->created_at->format('d/m/Y') }}
                            </div>
                        </div>

                        <table class="table" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th width="85%">Question</th>
                                    <th class="text-right">Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( json_decode($quiz->question_marks) as $question => $points)
                                <tr>
                                    <td>{{ str_replace('_', ' ', title_case($question)) }}</td>
                                    <td class="text-right">{{ $points }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>3 in 10?</td>
                                    <td class="text-right">{{ $quiz->{'3_in_10'} ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Points</strong></td>
                                    <td class="text-right"><strong>{{ $quiz->total_points }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @endisset
</div>
@endsection
