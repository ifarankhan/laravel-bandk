@extends('layouts.app-front')

@section('content')
    <div class="outer">
        <div class="inner">
            <div class="login-section">
                <div class="login-container">
                    <img src="images/logob&k.png" alt="img">
                    <ul>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <li>

                                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}">

                            </li>
                            <li>

                                <input type="password" placeholder="Password" name="password">
                            </li>
                            <li>
                                <button type="submit">Login</button>
                            </li>
                            <li>
                                <input type="checkbox" class="remember-me" value="Remember">
                                <span class="remember">Remember me</span>
                                <a href="#" class="forgot">Forgotten account?</a>
                            </li>
                        </form>
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
