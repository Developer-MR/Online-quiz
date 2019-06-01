<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<style>
    .background-img{
        background: url("images/online-login-quiz.png") no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<body class="page-header-fixed background-img">

    @include('partials.analytics')

    <div style="margin-top: 5%;"></div>

    <div class="container">
        @yield('content')
    </div>

    <div class="scroll-to-top" style="display: none;">
        <i class="fa fa-arrow-up"></i>
    </div>

    @include('partials.javascripts')

</body>
</html>