@extends('layouts.app-front-login')

@section('content')
    <div class="outer">
        <div class="inner">
            <div class="login-section">
                <div class="login-container">
                    <img src="/frontend/images/logob&k.png" alt="img">
                    <ul>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <li class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </li>
                            <li class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <input type="password" placeholder="Password" name="password">
                            </li>
                            <li>
                                <button type="submit">Login</button>
                            </li>
                            <li>
                                <input type="checkbox" class="remember-me" value="Remember">
                                <span class="remember">Remember me</span>
                                <a href="{{ route('password.request') }}" class="forgot">Forgotten account?</a>
                            </li>
                        </form>
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
