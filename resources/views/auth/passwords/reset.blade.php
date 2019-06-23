@extends('layouts.login')

@section('title', trans('login.reset_password_title'))

@section('headline', trans('login.reset_password_header'))

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email --}}
        <div class="form-group is-focused">
            {{ Form::label('email', trans('login.email'), ['class' => 'bmd-label-floating']) }}

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
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

        {{-- Confirm Password --}}
        <div class="form-group row">
            {{ Form::label('password-confirm', trans('login.confirm_password'), ['class' => 'bmd-label-floating']) }}

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        {{-- Submit --}}
        <div class="form-group row mb-0 mt-0">
            <button type="submit" class="btn btn-block btn-success btn-round">
                {!! config('icons.reset') !!} &ensp; {{ __('Reset Password') }}
            </button>
        </div>
    </form>    
@endsection
