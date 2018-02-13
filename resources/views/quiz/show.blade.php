@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <quiz-questions inline-template>
                <form action="{{ route('quiz.update', $quiz) }}" method="POST">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <div class="panel panel-default">
                        <div class="table-responsive">
                            <table class="table table-quiz">
                                @foreach ( $quiz->questions() as $count => $question )
                                <tr id="{{ str_slug(str_replace(' (Bonus)', '', $question['name']), '') }}">
                                    <td style="width: 80%; <?= ( $count == 0 ) ? 'border-top: 0px;' : ''; ?>">
                                        <input type="hidden" name="{{ str_slug(str_replace(' (Bonus)', '', $question['name']), '_') }}_score" value="0" data-max-score="{{ $question['points'] }}"/>
                                        <span class="question-name">{{ $question['name'] }}</span>
                                    </td>
                                    <td style="width: 10%; <?= ( $count == 0 ) ? 'border-top: 0px;' : ''; ?>">
                                        <div class="correct" @click="changeQuestionScore('correct', {{ $count + 1 }})">
                                            correct
                                        </div>
                                    </td>
                                    <td <?= ( $count == 0 ) ? 'style="border-top: 0px;"' : ''; ?>>
                                        <div class="incorrect" @click="changeQuestionScore('incorrect', {{ $count + 1 }})">
                                            incorrect
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                <tr id="three-in-ten">
                                    <td style="width: 80%;">
                                        <input type="hidden" name="three_in_ten" value="0" />
                                        <span class="question-name">3 in 10?</span>
                                    </td>
                                    <td style="width: 10%;">
                                        <div class="correct" @click="threeInTen(1)">
                                            yes
                                        </div>
                                    </td>
                                    <td>
                                        <div class="incorrect" @click="threeInTen(0)">
                                            no
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary btn-block" value="Submit" />
                </form>
            </quiz-questions>
        </div>
    </div>
</div>
@endsection
