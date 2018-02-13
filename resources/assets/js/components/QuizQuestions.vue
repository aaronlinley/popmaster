<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            changeQuestionScore: function(result, questionNumber) {
                var self = this;
                var score = $('input[type="hidden"][name="question_'+questionNumber+'_score"]').val();
                var maxScore = $('input[type="hidden"][name="question_'+questionNumber+'_score"]').attr('data-max-score');
                if ( result == 'correct' ) {
                    if ( score == 0 || score == 1 ) {
                        $('input[type="hidden"][name="question_'+questionNumber+'_score"]').val(maxScore);
                        $('#question'+questionNumber).find('.incorrect').text('incorrect');
                        $('#question'+questionNumber).find('.correct').text(maxScore);
                    } else {
                        $('input[type="hidden"][name="question_'+questionNumber+'_score"]').val(score - 1);
                        $('#question'+questionNumber).find('.correct').text(score - 1);
                    }
                } else {
                    $('input[type="hidden"][name="question_'+questionNumber+'_score"]').val(0);
                    $('#question'+questionNumber).find('.correct').text('correct');
                    $('#question'+questionNumber).find('.incorrect').text('0');
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
