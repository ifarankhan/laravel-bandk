@extends('layouts.app-front')
@section('css')
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
@endsection
@section('content')

    <?php
        $urlName = \Request::route()->getName();
    ?>
    @if($urlName == 'home.index')
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number" style="font-size: 40px;">{{ getTranslation('contact_bnk_admin') }}</h1>
                {{--<h2 style="font-size: 70px;">Access denied</h2>--}}
                <p style="font-size: 20px;">
                    {!! getTranslation('contact_bnk_admin_message') !!}
                </p>
            </div>
        </div>
    @else
        <div class="col-middle">
            <div class="text-center text-center">
                <h1 class="error-number" style="font-size: 150px;">403</h1>
                <h2 style="font-size: 70px;">Access denied</h2>
                <p style="font-size: 20px;">Full authentication is required to access this resource. <a href="#">Report this?</a>
                </p>
            </div>
        </div>
    @endif
@endsection