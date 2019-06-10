@extends('layouts.login')

@section('title', trans('login.title'))

@section('headline', trans('login.header'))

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        {{-- <div class="form-group is-focused">
            {{ Form::label('email', trans('login.email'), ['class' => 'bmd-label-floating']) }}

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div> --}}

        {{-- Username --}}
        <div class="form-group is-focused">
            {{ Form::label('username', trans('login.username'), ['class' => 'bmd-label-floating']) }}

            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>

        {{-- Password --}}
        <div class="form-group row">
            {{ Form::label('password', trans('login.password'), ['class' => 'bmd-label-floating']) }}

            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        {{-- Remember Me --}}
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label" for="remember">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    @lang('login.remember_me')
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </div>

        <hr class="mt-3">

        {{-- Submit --}}
        <div class="form-group row mb-0 mt-0">
            <button type="submit" class="btn btn-block btn-success btn-round">
                <i class="fa fa-sign-in"></i> &ensp; @lang('login.login_button')
            </button>
        </div>

        {{-- Forgot Password --}}
        {{-- <div class="text-center pt-2 pb-0">
            <a class="btn btn-link text-info py-0" href="{{ route('password.request') }}">
                <i class="material-icons">email</i> @lang('login.forgot_password')
            </a>
        </div> --}}

        <hr class="my-2">

        <div class="text-center py-0">
            @lang('login.new_here')
            <a href="{{ route('register') }}" class="btn btn-link py-0 pl-1 pr-0 text-info">
                @lang('login.create_account')
            </a>
        </div>
    </form>
@endsection
