<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <link rel="stylesheet" href="{{asset('css/flipclock.css')}}">
</head>

<body class="page-header-fixed">

    @include('partials.analytics')

    <div class="page-header navbar navbar-fixed-top">
        @include('partials.header')
    </div>

    <div class="clearfix"></div>

    <div class="page-container">
        <div class="page-sidebar-wrapper">
            @include('partials.sidebar')
        </div>

        <div class="page-content-wrapper">
            <div class="page-content">

                @if(isset($siteTitle))
                    <h3 class="page-title">
                        {{ $siteTitle }}
                    </h3>
                @endif

                <div class="row">
                    <div class="col-md-12">

                        @if (Session::has('message'))
                            <div class="note note-info">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        @if ($errors->count() > 0)
                            <div class="note note-danger">
                                <ul class="list-unstyled">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-to-top"
         style="display: none;">
        <i class="fa fa-arrow-up"></i>
    </div>

    {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
        <button type="submit">Logout</button>
    {!! Form::close() !!}

    @include('partials.javascripts')
     <!-- JavaScripts -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
     <script type="text/javascript" src="{{asset('js/flipclock.min.js')}}"></script>
     {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
     <script src="{{asset('js/sweetalert.min.js')}}"></script>
     <script>
 
         $('div.alert-success').delay(3000).slideUp(400);
 
         $(function(){
         $('a#btn-delete').on('click', function(e){
             e.preventDefault();
             e.stopPropagation();
             var $a = this;
 
             swal({
                         title: "Are you sure?",
                         text: "You will not be able to recover this category!",
                         type: "warning",
                         showCancelButton: true,
                         confirmButtonColor: '#DD6B55',
                         confirmButtonText: 'Yes, delete it!',
                         closeOnConfirm: false
                     },
                     function(){
                         //console.log($($a).attr('href'));
                         document.location.href=$($a).attr('href');
                     });
         });
         });
 
         $('#add-new-question').hide();
         $('#btn-add-new-question').on('click', function(){
             $('#add-new-question').slideDown();
         });
 
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': "{{ csrf_token() }}"
             }
         });
         @yield('script_clock')
         @yield('script_form')
     </script>
</body>
</html>