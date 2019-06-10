@extends('layouts.login')

@section('title', trans('login.signup_title'))

@section('headline', trans('login.signup_header'))

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="form-group is-focused">
            {{ Form::label('username', trans('login.username'), ['class' => 'bmd-label-floating']) }}

            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row" style="padding-left: 5px">
            {{-- Firstname --}}
            <div class="form-group col pl-0 pr-3">
                {{ Form::label('firstname', trans('login.firstname'), ['class' => 'bmd-label-floating']) }}

                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required>

                @if ($errors->has('firstname'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                @endif
            </div>
            {{-- Surname --}}
            <div class="form-group col px-0">
                {{ Form::label('surname', trans('login.surname'), ['class' => 'bmd-label-floating']) }}

                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required>
                
                @if ($errors->has('surname'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('surname') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{-- Email --}}
        {{-- <div class="form-group row">
            {{ Form::label('email', trans('login.email'), ['class' => 'bmd-label-floating']) }}

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div> --}}

        <div class="form-row" style="padding-left: 5px">
            {{-- Password --}}
            <div class="form-group col pl-0 pr-3">
                {{ Form::label('password', trans('login.password'), ['class' => 'bmd-label-floating']) }}

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            {{-- Confirm Password --}}
            <div class="form-group col px-0">
                {{ Form::label('password-confirm', trans('login.confirm_password'), ['class' => 'bmd-label-floating']) }}

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        {{-- Submit --}}
        <div class="form-group row mb-0 mt-4">
            <button type="submit" class="btn btn-block btn-success btn-round">
                <i class="fa fa-sign-in"></i> &ensp; @lang('login.signup_button')
            </button>
        </div>

        <hr class="mt-1 mb-4">
        
        {{-- Already have an account --}}
        <div class="text-center py-0">
            @lang('login.already_have_account')
            <a href="{{ route('login') }}" class="btn btn-link py-0 pl-1 pr-0 text-info">
                @lang('login.login_here')
            </a>
        </div>

    </form>
@endsection
