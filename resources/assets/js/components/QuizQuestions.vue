<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            changeRound1QuestionScore: function(result, questionNumber) {
                var self = this;
                var score = $('input[type="hidden"][name="round_1_question_'+questionNumber+'_score"]').val();
                var maxScore = $('input[type="hidden"][name="round_1_question_'+questionNumber+'_score"]').attr('data-max-score');
                if ( result == 'correct' ) {
                    if ( score == 0 || score == 1 ) {
                        $('input[type="hidden"][name="round_1_question_'+questionNumber+'_score"]').val(maxScore);
                        $('#round1question'+questionNumber).find('.incorrect').text('incorrect');
                        $('#round1question'+questionNumber).find('.correct').text(maxScore);
                    } else {
                        $('input[type="hidden"][name="round_1_question_'+questionNumber+'_score"]').val(score - 1);
                        $('#round1question'+questionNumber).find('.correct').text(score - 1);
                    }
                } else {
                    $('input[type="hidden"][name="round_1_question_'+questionNumber+'_score"]').val(0);
                    $('#round1question'+questionNumber).find('.correct').text('correct');
                    $('#round1question'+questionNumber).find('.incorrect').text('0');
                }
            },
            changeRound2QuestionScore: function(result, questionNumber) {
                var self = this;
                var score = $('input[type="hidden"][name="round_2_question_'+questionNumber+'_score"]').val();
                var maxScore = $('input[type="hidden"][name="round_2_question_'+questionNumber+'_score"]').attr('data-max-score');
                if ( result == 'correct' ) {
                    if ( score == 0 || score == 1 ) {
                        $('input[type="hidden"][name="round_2_question_'+questionNumber+'_score"]').val(maxScore);
                        $('#round2question'+questionNumber).find('.incorrect').text('incorrect');
                        $('#round2question'+questionNumber).find('.correct').text(maxScore);
                    } else {
                        $('input[type="hidden"][name="round_2_question_'+questionNumber+'_score"]').val(score - 1);
                        $('#round2question'+questionNumber).find('.correct').text(score - 1);
                    }
                } else {
                    $('input[type="hidden"][name="round_2_question_'+questionNumber+'_score"]').val(0);
                    $('#round2question'+questionNumber).find('.correct').text('correct');
                    $('#round2question'+questionNumber).find('.incorrect').text('0');
                }
            },
            threeInTen: function(result) {
                var self = this;
                $('input[type="hidden"][name="three_in_ten"]').val(result);
                if ( result == 1 ) {
                    $('#three-in-ten').find('.correct').html('&#10004;');
                    $('#three-in-ten').find('.incorrect').text('no');
                } else {
                    $('#three-in-ten').find('.correct').text('yes');
                    $('#three-in-ten').find('.incorrect').html('&#10008;');
                }
            }
        }
    }
</script>
