@extends('layouts.app')

<style>
    .container-fostrap {
    display: table-cell;
    padding: 1em;
    text-align: center;
    vertical-align: middle;
    }

    h1.heading {
    color: #fff;
    font-size: 1.15em;
    font-weight: 900;
    margin: 0 0 0.5em;
    color: #505050;
    }
    @media (min-width: 450px) {
    h1.heading {
        font-size: 3.55em;
    }
    }
    @media (min-width: 760px) {
    h1.heading {
        font-size: 3.05em;
    }
    }
    @media (min-width: 900px) {
    h1.heading {
        font-size: 3.25em;
        margin: 0 0 0.3em;
    }
    } 
    .card {
    display: block; 
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); 
        transition: box-shadow .25s; 
    }
    .card:hover {
    box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .img-card {
    width: 100%;
    height:200px;
    border-top-left-radius:2px;
    border-top-right-radius:2px;
    display:block;
        overflow: hidden;
    }
    .img-card img{
    width: 100%;
    height: 200px;
    transition: all .25s ease;
    } 
    .card-content {
    padding:15px;
    text-align:left;
    }
    .card-title {
    margin-top:0px;
    font-weight: 700;
    font-size: 1.65em;
    text-align: center;
    }
    .card-title a {
    color: #000;
    text-decoration: none !important;
    }
    .card-read-more {
    border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
    text-decoration: none !important;
    padding:10px;
    font-weight:600;
    text-transform: uppercase;
        background-color: aliceblue;

    }
    .middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
    }
    .text {
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    padding: 16px 32px;
    }
    .container .image {
    opacity: 0.3;
    }

    .container .middle {
    opacity: 1;
    }
</style>

@section('content')
    <h3 class="page-title">All Quiz</h3>

    <div class="panel panel-default">
        {{-- <div class="panel-heading">
            Free Demo quiz
        </div> --}}
    <?php //dd($questions) ?>
    @if(count($topics) > 0)
        <section class="wrapper">
                <div class="container-fostrap">
                    <h1> Free Demo quiz</h1> 
                    <div class="content">
                        <div class="container">
                            <div class="row">
                                @foreach ($topics as $topic)
                                <div class="col-xs-12 col-sm-4">
                                        <div class="card" style="">
                                            <a class="img-card" href="{{ url('test-detail', [$topic->id]) }}">
                                                <img src="https://static.adda247.com/images/online-mock-tests.svg" />
                                            </a>
                                            <div class="card-content">
                                                <h4 class="card-title">
                                                    <a href="{{ url('test-detail', [$topic->id]) }}"> Quiz {{$loop->index+1}} </a><br><br>
                                                    {{-- <a href="#">  {{$topic->title}} </a><br><br> --}}
                                                    <span style="font-size:16px;">Exam Duration : {{$topic->duration}} minutes</span>
                                                </h4>
                                                {{-- <p class="">
                                                        Quiz 1
                                                </p> --}}
                                            </div>
                                            <div class="card-read-more">
                                                <a href="{{ url('test-detail', [$topic->id]) }}" class="btn btn-link btn-block">
                                                    Start
                                                </a>
                                            </div>
                                        </div>
                                    </div> 
                                @endforeach
                                
                                {{-- <div class="col-xs-12 col-sm-4">
                                    <div class="card">
                                        <a class="img-card" href="#">
                                        <img src="https://static.adda247.com/images/online-mock-tests.svg" />
                                      </a>
                                        <div class="card-content">
                                            <h4 class="card-title">
                                                <a href="#"> Quiz 2
                                              </a>
                                            </h4>
                                           
                                        </div>
                                        <div class="card-read-more">
                                            <a href="#" class="btn btn-link btn-block">
                                                Start
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <div class="card">
                                        <a class="img-card" href="#">
                                        <img src="https://static.adda247.com/images/online-mock-tests.svg" />
                                      </a>
                                        <div class="card-content">
                                            <h4 class="card-title">
                                                <a href="#">Quiz 3
                                              </a>
                                            </h4>
                                            
                                        </div>
                                        <div class="card-read-more">
                                            <a href="#" class="btn btn-link btn-block">
                                                Start
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    @endif
    </div>
    {{-- <div class="panel panel-default">
           
           
        @if(count($topics) > 0)
            <section class="wrapper">
                <div class="container-fostrap">
                    <h1> Paid Quiz</h1>
                            
                    <div class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <div class="card">
                                        <a class="img-card" href="#">
                                        <img src="https://static.adda247.com/images/online-mock-tests.svg" class="image"/>
                                        </a>

                                        <div class="middle">
                                            <div class="text">Lock</div>
                                        </div>

                                        <div class="card-content">
                                            <h4 class="card-title">
                                                <a href="#"> Quiz 1
                                                </a>
                                            </h4>
                                           
                                        </div>
                                        <div class="card-read-more">
                                            <a href="#" class="btn btn-link btn-block">
                                                    Lock
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <div class="card">
                                        <a class="img-card" href="#">
                                        <img src="https://static.adda247.com/images/online-mock-tests.svg" class="image" />
                                        </a>
                                        <div class="middle">
                                                <div class="text">Lock</div>
                                            </div>
                                        <div class="card-content">
                                            <h4 class="card-title">
                                                <a href="#"> Quiz 2
                                                </a>
                                            </h4>
                                            
                                        </div>
                                        <div class="card-read-more">
                                            <a href="#" class="btn btn-link btn-block">
                                                    Lock
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <div class="card">
                                        <a class="img-card" href="#">
                                        <img src="https://static.adda247.com/images/online-mock-tests.svg" class="image"/>
                                        </a>
                                        <div class="middle">
                                            <div class="text">Lock</div>
                                        </div>
                                        <div class="card-content">
                                            <h4 class="card-title">
                                                <a href="#">Quiz 3
                                                </a>
                                            </h4>
                                          
                                        </div>
                                        <div class="card-read-more">
                                            <a href="#" class="btn btn-link btn-block">
                                                Lock
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>      
                
                </div>
            </section>
        @endif
    </div> --}}

@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>

@stop
