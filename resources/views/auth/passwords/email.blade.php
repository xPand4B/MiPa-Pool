@extends('layouts.login')

@section('title', trans('login.reset_password_title'))

@section('headline', trans('login.reset_password_header'))

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- Email --}}
        <div class="form-group is-focused">
            {{ Form::label('email', trans('login.email'), ['class' => 'bmd-label-floating']) }}

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        {{-- Submit --}}
        <div class="form-group row mb-0">
            <button type="submit" class="btn btn-block btn-success btn-round">
                {!! config('icons.send') !!} &ensp; @lang('login.get_reset_email')
            </button>
        </div>

        <hr class="mt-1 mb-4">

        <div class="text-center py-0">
            @lang('login.new_here')
            <a href="{{ route('register') }}" class="btn btn-link py-0 pl-1 pr-0 text-info">
                @lang('login.create_account')
            </a>
        </div>
        
        <div class="py-1"></div>

        {{-- Already have an account --}}
        <div class="text-center py-0">
            @lang('login.already_have_account')
            <a href="{{ route('login') }}" class="btn btn-link py-0 pl-1 pr-0 text-info">
                @lang('login.login_here')
            </a>
        </div>
    </form>
@endsection
