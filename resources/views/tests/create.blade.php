@extends('layouts.app')

@section('content')
<div id="counter1"></div>

@section('script_clock')
        $(function() {
            var clock = $('#counter1').FlipClock({{$duration*60}}, {
                autoStart: false,
                countdown: true,
                clockFace: 'MinuteCounter',
                callbacks: {
                     interval: function () {
                         var time = clock.getTime().time;
                         //alert(time);
                        @foreach($questions as $q)
                            $('#time_taken{{$q->id}}').val(time);
                        @endforeach
                    },
                stop: function(){
                alert("The time has run out!");
                //window.location.replace("{{ route('tests.store') }}");
                }
        }
        });
        clock.start();

 @stop
    {{-- <h3 class="page-title">Demo Quiz</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.quiz')
        </div>
     
    @if(count($questions) > 0)
        <div class="panel-body">
      
        @foreach($questions as $question)
            @if ($i > 1) <hr /> @endif
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ $i }}.<br />{!! nl2br($question->question_text) !!}</strong>

                        @if ($question->code_snippet != '')
                            <div class="code_snippet">{!! $question->code_snippet !!}</div>
                        @endif

                        <input type="hidden" name="questions[{{ $i }}]"  value="{{ $question->id }}">
                        <input type="hidden" name="topic_id"  value="{{ $topic->id }}">
                    @foreach($question->options as $option)
                        <br>
                        <label class="radio-inline">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->id }}">
                            {{ $option->option }}
                        </label>
                    @endforeach
                    </div>
                </div>
            </div>
       
        @endforeach
        </div>
    @endif
    </div>

    {!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!} --}}

    @foreach($questions as $question)

    <div class="jumbotron" id="jumbotron{{$question->id}}"
            @if($question->id != $current_question_id)
                style="display: none;"
            @endif
            >
        <p>Question #{{$question->id}}</p>
        <p>{{$question->question_text}}</p>

        {!! Form::open(['action'=>['TestsController@postSaveQuestionResult', $topic->id], 'method'=>'post', 'id'=>'frm'.$question->id]) !!}

        <ul id="answer-radio{{$question->id}}">
            <div class="btn-group" data-toggle="buttons">

                @foreach($question->options as $option)
                        <br>
                        <label class="radio-inline">
                            <input
                                type="radio"
                                name="answers"
                                value="{{ $option->id }}">
                            {{ $option->option }}
                        </label>
                    @endforeach

            </div>
        </ul>

        {!! Form::input('hidden','question_id', $question->id) !!}
        {!! Form::input('hidden','topic_id', $topic->id) !!}
        {{-- {!! Form::input('hidden','time_taken'.$question->id,null,['id'=>'time_taken'.$question->id]) !!} --}}

        {!! Form::token() !!}


    @if($question->id != $first_question_id)
            <!--a class="btn btn-info" href="#" id="previous-btn" role="button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</a-->
        @endif
        <!--a class="btn btn-info" href="{{action('TestsController@postSaveQuestionResult',[$topic->id])}}" role="button">Next <span class="glyphicon glyphicon-chevron-right"></span></a-->

        @if($question->id == $last_question_id)
            {!! Form::submit('Last', ['class'=>'btn btn-info']) !!}
        @else
            {!! Form::submit('Next', ['class'=>'btn btn-info']) !!}
        @endif
        {!! Form::close() !!}
    </div>
    @if($questions->count()>1)
    @section('script_form')
        $(function() {
    
        //console.log({{$question->id}});
        //console.log({{$last_question_id}});
    
        $('#frm{!!$question->id!!}').on('submit', function(e){
        e.preventDefault();
                var form = $(this);
                var $formAction = form.attr('action');
    
                var $userAnswer = $('input[name=answers]:checked', $('#frm{{$question->id}}')).val();
    
                $.post($formAction, $(this).serialize(), function(data){
    
                    //if(data.next_question_id != null)
                    $('#jumbotron{{$question->id}}').hide();
                    console.log(data.next_question_id);
                    $('#jumbotron' + data.next_question_id+'').show();
               });
    
            });
        });
    
        });
    @stop
    @endif
    @endforeach 
    @stop
<script type="text/javascript">
$(document).ready(function(){
    var offset=0;
    loadCurrentPage();
    $("#next, #prev").click(function(){
        offset = ($(this).attr('id')=='next') ? offset + 10 : offset - 10;
        if (offset<0)
            offset=0;
        else
            loadCurrentPage();
    });
    function loadCurrentPage(){
    $.ajax({
        url: 'posts.php?offset=' + offset ,
        type: 'POST',
        cache: true,
        success: function (data) {
            $('#displayResults').html(data);
        }
    });
    }
});
</script>
@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    {{-- <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script> --}}

@stop
