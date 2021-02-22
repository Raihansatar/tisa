<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if(Request::is('/'))
            Tisa Enterprise
        @elseif(Request::is('product'))
            Product
        @elseif(Request::is('debt'))
            Debt - {{ Auth::user()->username }}
        @else
            No title
        @endif
    </title>

    <link href="{{ asset('assets/css/bootstrap-5/bootstrap.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('assets/css/bootstrap-icons-1.3.0/bootstrap-icons.css') }}" rel="stylesheet" crossorigin="anonymous">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> --}}
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    @stack('custom-css')
</head>
<body>
    <header>
        @include('layouts.navbar')
    </header>

    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}" crossorigin="anonymous"></script>
    @stack('custom-js')
</body>
</html>


