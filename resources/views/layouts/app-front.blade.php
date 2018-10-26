<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>B&k!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" type="text/css">
    <style>
        .main-header-active {
            background: #f37522 !important;
            transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
        }
    </style>
    <script>
        var _token = "{{ csrf_token() }}";
    </script>
    @yield('css')
</head>

<body>

<div class="header container-fluid zero-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 margin-10">
                <div class="col-xs-8 text-left zero-padding">
                    <img src="/frontend/images/logob&k.png" alt="logo">
                    <div class="links">
                        <a href="{{ route('home.index') }}" class="link1 {{ \Request::route()->getName() == 'home.index' ? 'main-header-active': ''}}">{{ getTranslation('emergency_app') }}</a>
                        <a href="{{ route('claim.create') }}" class="link2 {{ \Request::route()->getName() == 'claim.create' ? 'main-header-active': ''}}">{{ getTranslation('claim_form') }}</a>
                        <?php
                            $roles = \Auth::user()->roles;
                            $rolesArray = [];
                            if(count($roles) > 0) {
                                $rolesArray = $roles->pluck('name')->toArray();
                            }
                        ?>
                        @if(in_array('ADMIN', $rolesArray))
                            <a href="{{ route('dashboard.index') }}" class="link2 {{ \Request::route()->getName() == 'dashboard.index' ? 'main-header-active': ''}}">{{ getTranslation('admin_panel') }}</a>
                        @elseif(in_array('AGENT', $rolesArray))
                            <a href="{{ route('claim.index') }}" class="link2 {{ \Request::route()->getName() == 'claim.index' ? 'main-header-active': ''}}">{{ getTranslation('my_claims') }}</a>
                        @endif
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
        @yield('content')
    </div>
</div>

<div id="modal-delete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure to delete?</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger delete-confirm">{{ getTranslation('delete') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ getTranslation('close') }}</button>
            </div>
        </div>

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
<script src="{{ asset('/common/js/common.js') }}"></script>
@yield('js')
</body>
</html>

