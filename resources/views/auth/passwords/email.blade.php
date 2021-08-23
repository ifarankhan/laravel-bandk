@extends('layouts.app-front-login')

@section('content')

    <style>
        .login-container {
            max-width: 456px;
        }
    </style>
    <div class="outer">
        <div class="inner">
            <div class="login-section">
                <div class="login-container">
                    <img src="/frontend/images/logob&k.png" alt="img">
                    <ul>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-8 ">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" col-md-offset-4 col-md-8 ">
                                <a href="{{ url('login') }}">
                                    Back to Login
                                </a>
                            </div>
                        </div>
                    </form>
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
