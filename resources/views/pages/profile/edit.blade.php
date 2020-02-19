@extends('layouts.main')

@section('title', trans('page.profile.title'))

@section('headline')
    @include('partials._breadcrumb', [
        'items' => [
            trans('breadcrumb.profile.index'),
            $user->fullname
        ]
    ])
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="row">

            {{-- Profile --}}
            <div class="col-md-6">
                <div class="card">
                    {{-- Card Header --}}
                    <div class="card-header card-header-transparent card-header-icon">
                        <div class="card-icon p-0 bg-transparent">
                            @if (file_exists(realpath(config('filesystems.avatar.path').$user->avatar)))
                            <img
                                class="rounded-circle"
                                src="{{ asset(config('filesystems.avatar.path').$user->avatar) }}"
                                title="{{ $user->firstname }} {{ $user->surname}} ({{ $user->username }})"
                                width="82px"
                                height="82px"
                            >
                            @endif
                        </div>

                        {{-- Title --}}
                        <h4 class="card-title row mt-0">
                            <strong class="col mt-4">
                                @lang('forms.profile.headline')
                            </strong>
                        </h4>
                    </div>

                    <hr>

                    {{-- Card Content --}}
                    <div class="card-body">

                        <div class="row">
                            {{-- Reset Avatar --}}
                            <div class="col-md-12 my-0 py-0">
                                {!! Form::open([
                                    'route' => 'profile.reset.avatar',
                                    'method' => 'POST'
                                ]) !!}
                                    <label for="reset_avatar" class="btn btn-block btn-default btn-round">
                                        {!! config('icons.reset') !!} &ensp; @lang('forms.profile.reset_avatar')
                                    </label>
                                    <button type="submit" id="reset_avatar" hidden></button>

                                {!! Form::close() !!}
                            </div>


                            {{-- Avatar --}}
                            <div class="col-md-12 my-0 py-0">
                            {!! Form::model($user, [
                                'route'  => [
                                    'profile.update'
                                ],
                                'method' => 'PUT',
                                'enctype'=> 'multipart/form-data'
                            ]) !!}

                                <label for="avatar" class="btn btn-block btn-success btn-round">
                                    {!! config('icons.upload') !!} &ensp; @lang('forms.profile.avatar.label')
                                </label>
                                <input id="avatar" type="file" name="avatar" accept="image/*" size="2048" hidden>

                                <small id="fileHelp" class="form-text text-muted">
                                    @lang('forms.profile.avatar.helper')
                                </small>

                                @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <hr class="mb-0">

                        {{-- Username --}}
                        <div class="form-group">
                            {{ Form::label('username', trans('forms.profile.username'), ['class' => 'bmd-label-floating']) }}

                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username }}" required>

                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-row" style="padding-left: 5px">
                            {{-- Firstname --}}
                            <div class="form-group col-lg pl-0 pr-3">
                                {{ Form::label('firstname', trans('forms.profile.firstname'), ['class' => 'bmd-label-floating']) }}

                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ $user->firstname }}" required>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- Surname --}}
                            <div class="form-group col-lg px-0">
                                {{ Form::label('surname', trans('forms.profile.surname'), ['class' => 'bmd-label-floating']) }}

                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $user->surname }}" required>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            {{ Form::label('email', trans('forms.profile.email'), ['class' => 'bmd-label-floating']) }}

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{-- Password + Confirm --}}
                        <div class="form-row" style="padding-left: 5px">
                            {{-- Password --}}
                            <div class="form-group col-lg pl-0 pr-3">
                                {{ Form::label('password', trans('forms.profile.password'), ['class' => 'bmd-label-floating']) }}

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- Confirm Password --}}
                            <div class="form-group col-lg px-0">
                                {{ Form::label('password-confirm', trans('forms.profile.confirm_password'), ['class' => 'bmd-label-floating']) }}

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        {{-- About Me --}}
                        <div class="form-group">
                            {{ Form::label('about_me', trans('forms.profile.about_me'), ['class' => 'bmd-label-floating']) }}
                            {{ Form::textarea('about_me', null, [
                                        'class'         => 'form-control',
                                        'rows'          => '5',
                                        'minlenght'     => '5',
                                        'maxlenght'     => '255'
                            ]) }}

                                @if ($errors->has('about_me'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('about_me') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{-- Submit --}}
                        <div class="form-group row">
                            <button type="submit" class="btn btn-block btn-primary btn-round">
                                {!! config('icons.refresh') !!} &ensp; @lang('forms.profile.submit')
                            </button>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="col-md-6">
                <div class="card">
                    {{-- Header --}}
                    <div class="card-header card-header-primary">
                        <h4 class="card-title mt-0">
                            <strong>
                                {!! config('icons.stats') !!} &ensp; @lang('page.profile.stats.headline')
                            </strong>
                        </h4>
                    </div>

                    <hr>

                    {{-- Card Content --}}
                    <div class="card-body">
                        {{-- Spend money --}}
                        <div class="row">
                            <div class="col">
                                <div class="card card-stats">
                                    {{-- Header --}}
                                    <div class="card-header card-header-success card-header-icon">
                                        <div class="card-icon">
                                            {!! config('icons.money') !!}
                                        </div>
                                        <p class="card-category">@lang('page.profile.stats.spend')</p>
                                        <h3 class="card-title">
                                            {{ $money_spend }} <small>{{ config('app.currency') }}</small>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Number orders --}}
                        <div class="row">
                            <div class="col">
                                <div class="card card-stats">
                                    {{-- Header --}}
                                    <div class="card-header card-header-warning card-header-icon">
                                        <div class="card-icon">
                                            {!! config('icons.shop') !!}
                                        </div>
                                        <p class="card-category">@lang('page.profile.stats.orders')</p>
                                        <h3 class="card-title">
                                            {{ $order_count }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Order per time --}}
                        <div class="row">
                            <div class="col">
                                <div class="card card-stats">
                                    {{-- Header --}}
                                    <div class="card-header card-header-info card-header-icon">
                                        <div class="card-icon">
                                            {!! config('icons.calender') !!}
                                        </div>
                                        <p class="card-category">@lang('page.profile.stats.month')</p>
                                        <h3 class="card-title">
                                            {{ $order_count_this_month }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
