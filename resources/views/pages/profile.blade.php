@extends('layouts.main')

@section('title', trans('page.profile.title'))

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item active" aria-current="page">@lang('page.profile.breadcrumb.index')</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->firstname}} {{ $user->surname}}</li>
        </ol>
    </nav>
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
                            <img class="rounded-circle" src="{{ asset(config('filesystems.avatar.path').$user->avatar) }}" title="{{ $user->firstname }} {{ $user->surname}} ({{ $user->username }})" width="82px" height="82px">
                            @endif
                        </div>

                        {{-- Title --}}
                        <h4 class="card-title row mt-0">
                            <strong class="col mt-4">
                                @lang('page.profile.form.headline')
                            </strong>
                        </h4>
                    </div>

                    <hr>

                    {{-- Card Content --}}
                    <div class="card-body">

                        <div class="row">
                            {{-- Reset Avatar --}}
                            <div class="col my-0 py-0">
                                {!! Form::open([
                                    'route' => 'profile.reset.avatar',
                                    'method' => 'POST'
                                ]) !!}
                                    <label for="reset_avatar" class="btn btn-block btn-default btn-round">
                                        <i class="fa fa-repeat" aria-hidden="true"></i> &ensp; @lang('page.profile.form.reset_avatar')
                                    </label>
                                    <button type="submit" id="reset_avatar" hidden></button>

                                {!! Form::close() !!}
                            </div>

                            {!! Form::model($user, [
                                'route'  => [
                                    'profile.update.data'
                                ],
                                'method' => 'PUT',
                                'enctype'=> 'multipart/form-data'
                            ]) !!}

                            {{-- Avatar --}}
                            <div class="col my-0 py-0">
                                <label for="avatar" class="btn btn-block btn-success btn-round">
                                    <i class="fa fa-upload" aria-hidden="true"></i> &ensp; @lang('page.profile.form.avatar.label')
                                </label>
                                <input id="avatar" type="file" name="avatar" accept="image/*" size="2048" hidden>
                                
                                <small id="fileHelp" class="form-text text-muted">
                                    @lang('page.profile.form.avatar.helper')
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
                            {{ Form::label('username', trans('page.profile.form.username'), ['class' => 'bmd-label-floating']) }}
                            
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
                                {{ Form::label('firstname', trans('page.profile.form.firstname'), ['class' => 'bmd-label-floating']) }}

                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ $user->firstname }}" required>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- Surname --}}
                            <div class="form-group col-lg px-0">
                                {{ Form::label('surname', trans('page.profile.form.surname'), ['class' => 'bmd-label-floating']) }}

                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $user->surname }}" required>
                                
                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Email --}}
                        {{-- <div class="form-group">
                            {{ Form::label('email', trans('page.profile.form.email'), ['class' => 'bmd-label-floating']) }}

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div> --}}

                        {{-- Password + Confirm --}}
                        <div class="form-row" style="padding-left: 5px">
                            {{-- Password --}}
                            <div class="form-group col-lg pl-0 pr-3">
                                {{ Form::label('password', trans('page.profile.form.password'), ['class' => 'bmd-label-floating']) }}

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- Confirm Password --}}
                            <div class="form-group col-lg px-0">
                                {{ Form::label('password-confirm', trans('page.profile.form.confirm_password'), ['class' => 'bmd-label-floating']) }}

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group row">
                            <button type="submit" class="btn btn-block btn-primary btn-round"> 
                                <i class="fa fa-refresh"></i> &ensp; @lang('page.profile.form.submit')
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
                                <i class="fa fa-sm fa-line-chart" aria-hidden="true"></i> &ensp; @lang('page.profile.stats.headline')
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
                                            <i class="fa fa-eur"></i>
                                        </div>
                                        <p class="card-category">@lang('page.profile.stats.spend')</p>
                                        <h3 class="card-title">
                                            {{ str_replace('.', ',', $money_spend) }} <small>€</small>
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
                                            <i class="material-icons">store</i>
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
                                            <i class="fa fa-calendar-o"></i>
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
