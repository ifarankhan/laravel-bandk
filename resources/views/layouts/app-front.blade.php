<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DCG</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container-fluid zero-padding">
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>



<script type="text/javascript" src="{{ asset('frontend/script/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/script/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/script/custom.js') }}"></script>
</body>
</html>

