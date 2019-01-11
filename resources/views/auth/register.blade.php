@extends('layouts.login')

@section('title')
    | @lang('login.signup_title')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body pb-2">

                    {{-- Header --}}
                    <div class="h2 pb-2">
                        @lang('login.signup_header')
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="form-group is-focused">
                            <label for="username" class="bmd-label-floating">
                                @lang('login.username')
                            </label>

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
                                <label for="firstname" class="bmd-label-floating">
                                    @lang('login.firstname')
                                </label>

                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- Surname --}}
                            <div class="form-group col px-0">
                                <label for="surname" class="bmd-label-floating">
                                    @lang('login.surname')
                                </label>

                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required>
                                
                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group row">
                            <label for="email" class="bmd-label-floating">
                                @lang('login.email')
                            </label>

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-row" style="padding-left: 5px">
                            {{-- Password --}}
                            <div class="form-group col pl-0 pr-3">
                                <label for="password" class="bmd-label-floating">
                                    @lang('login.password')
                                </label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- Confirm Password --}}
                            <div class="form-group col px-0">
                                <label for="password-confirm" class="bmd-label-floating">
                                    @lang('login.confirm_password')
                                </label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group row mb-0 mt-4">
                            <button type="submit" class="btn btn-block btn-success">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
