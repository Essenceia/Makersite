<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/custom.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('/css/skeleton.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('/css/normalize.css') }}" />
<script type = "text/javascript"
        src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<html>
    <body>
    @include('navbar')
    <div class="container u-max-full-width">
        @yield('content')
    </div>
    {{--@include('footer')--}}
    </body>
</html>