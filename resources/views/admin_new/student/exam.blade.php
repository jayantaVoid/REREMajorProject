@extends('admin_new.layouts.app')
@section('content')
    <div class="content container-fluid">
        {{-- @php
            $getTime = '00:01';
        @endphp --}}
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Exam</h3>
                    <ul class="breadcrumb">
                        <h4 class="pr-5 timer" data-val="{{ $getExamTime[0]->exam_time }}">{{ $getExamTime[0]->exam_time }}</h4>
                    </ul>

                </div>

            </div>
        </div>
        @if (Session::has('status'))
            <p class="alert alert-info">{{ Session::get('status') }}</p>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.exam-submit') }}" method="POST" id="exam_form">
                            @csrf
                            <input type="hidden" name="time" id="get_time">
                            <input type="hidden" name="exam_id" id="" value="{{ $getExamTime[0]->id }}">
                            <input type="hidden" name="user_id" id="" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="exam_duration" id="" value="{{ $getExamTime[0]->exam_time }}">
                            @foreach ($getQuestion as $key => $question)
                                <input type="hidden" name="question_id[]" id="" value="{{ $question->id }}">
                                <div class="question" id="question{{ $key + 1 }}">
                                    <h5 class="">Q{{ $key + 1 }} . {{ $question->name }}</h5>
                                    <ul class="options">
                                        <input type="hidden" name="answers_{{ $key + 1 }}"
                                            id="answers_{{ $key + 1 }}">
                                        @foreach ($question->show_answer as $p => $answer)
                                            <br>
                                            <li>
                                                <label
                                                    for="q{{ $p + 1 }}_option{{ $p + 1 }}">{{ $p + 1 }}.
                                                    {{ $answer->option }}</label>
                                                <input type="radio" name="radio_{{ $key + 1 }}"
                                                    value="{{ $answer->id }}" data-id="{{ $key + 1 }}"
                                                    class="select-ans">
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            @endforeach
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button
                                class="btn-warning btn-sm" id="submit_btn">Submit</button>
                        </form>
                        <div class="button-container">
                            <button class="prev-Button btn btn-primary btn-sm" id="previousButton"
                                disabled>Previous</button>
                            <button class="next-button btn btn-primary btn-sm" id="nextButton">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#submit_btn").hide();
            var currentQuestion = 1;
            var totalQuestions = $(".question").length;

            showQuestion(currentQuestion);

            $("#nextButton").click(function() {
                if (currentQuestion < totalQuestions) {
                    currentQuestion++;
                    showQuestion(currentQuestion);
                }
            });

            $("#previousButton").click(function() {
                if (currentQuestion > 1) {
                    currentQuestion--;
                    showQuestion(currentQuestion);
                }
            });

            function showQuestion(questionNumber) {
                $(".question").hide();
                $("#question" + questionNumber).show();

                if (questionNumber === 1) {
                    $("#previousButton").prop("disabled", true);
                } else {
                    $("#previousButton").prop("disabled", false);
                }

                if (questionNumber === totalQuestions) {
                    $("#submit_btn").show();
                    $("#nextButton").hide();
                } else {
                    $("#nextButton").text("Next");
                }
            }
            $('#previousButton').click(function() {
                $("#nextButton").show();
            })
            $('.select-ans').click(function() {
                var no = $(this).attr('data-id')
                $('#answers_' + no).val($(this).val())
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            var etime = $('.timer').attr('data-val')
            var time = etime.split(":");
            $('.timer').text(time[0] + ' : ' + time[1] + ' : 00 Left')
            var hours = parseInt(time[0])
            var minutes = parseInt(time[1])
            var seconds = 60
            var stop_timer = setInterval(() => {
                if(hours == 0 && minutes == 0 && seconds == 0){
                    $('#get_time').val(hours+':'+minutes+':'+seconds)
                    clearInterval(stop_timer)
                    $('#exam_form').submit();

                }
                if (seconds == 0 || seconds == 60) {
                    minutes--
                    seconds = 59
                }
                if (minutes == 0 && hours != 0) {
                    hours--
                    minutes = 59
                    seconds = 59
                }
                $('#get_time').val(hours+':'+minutes+':'+seconds)
                let tempHours = hours.toString().length > 1 ? hours : '0' + hours
                let tempMinutes = minutes.toString().length > 1 ? minutes : '0' + minutes
                let tempSeconds = seconds.toString().length > 1 ? seconds : '0' + seconds

                $('.timer').text(tempHours + ' : ' + tempMinutes + ' : ' + tempSeconds + ' Left')
                seconds--
            }, 1000);
        });
    </script>
@endpush
