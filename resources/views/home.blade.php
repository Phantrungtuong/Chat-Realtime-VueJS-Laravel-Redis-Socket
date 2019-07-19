
<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('css/all.css')}}" >
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.mCustomScrollbar.min.js')}}"></script>


</head>
<body>
<div class="container-fluid h-100">
    <div class="row justify-content-center h-100" id="app">

            <chat-layout></chat-layout>


    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>

