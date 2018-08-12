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

<div class="header container-fluid zero-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 margin-10">
                <div class="col-xs-8 text-left zero-padding">
                    <img src="/frontend/images/logob&k.png" alt="logo">
                    <div class="links">
                        <a href="{{ route('home.index') }}" class="link1">Home</a>
                        <a href="#" class="link2">Claim Form</a>
                    </div>
                </div>
                <div class="col-xs-4 zero-padding text-right padding-15">
                    <div class="right-section">
                        <img src="/frontend/images/logout.png" alt="img" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="cursor: pointer;">
                        <h3 onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">logout</h3>
                        <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 column">
            <div class="sideNav" style="width: 100%;height: 100%;">
                <button>
                    <span></span>
                </button>
                <ul>
                    <?php
                        $html = '';
                    ?>
                    {!! getLeftMenu($categories, $html) !!}
                    {{--@if(count($categories) > 0)
                        @foreach($categories as $category)
                            <li class="home"><a href="javascript:;">{{ $category->title }}</a>
                                @if($category->childrenCount > 0)
                                    <ul class="nav child_menu">
                                        @foreach($category->children as $child)
                                            <li class="current-page"><a href="#">{{ $child->title }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif--}}
                   {{-- <li class="home"><a href="javascript:;">Home</a>
                        <ul class="nav child_menu">
                            <li class="current-page"><a href="#">Dashboard</a></li>
                            <li><a href="index2.html">Dashboard2</a></li>
                            <li><a href="index3.html">Dashboard3</a></li>
                        </ul>
                    </li>


                    <li class="newIndividual"><a href="javascript:;">New Appliction</a>
                        <ul class="nav child_menu">
                            <li class="current-page"><a href="#">Dashboard</a></li>
                            <li><a href="index2.html">Dashboard2</a></li>
                            <li><a href="index3.html">Dashboard3</a></li>
                        </ul>
                    </li>
                    <li class="howToGuide"><a href="javascript:;">How-to guides</a>
                        <ul class="nav child_menu">
                            <li class="current-page"><a href="#">Dashboard</a></li>
                            <li><a href="index2.html">Dashboard2</a></li>
                            <li><a href="index3.html">Dashboard3</a></li>
                        </ul>
                    </li>--}}
                </ul>
            </div>
        </div>
        @yield('content')
    </div>
</div>

<div class="footer container-fluid zero-padding text-center">
    <div class="container">
        <div class="row">
            <span class="footer-text">© 2013-2016 KeepTruckin, Inc. All rights reserved.</span>
            <img src="/frontend/images/white-logo.png" alt="logo">
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ asset('frontend/script/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/script/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/script/custom.js') }}"></script>
</body>
</html>

