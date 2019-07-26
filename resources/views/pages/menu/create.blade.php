@extends('layouts.main')

@section('title', $order->name)

@section('headline')
    @include('partials._breadcrumb', [
        'items' => [
            trans('breadcrumb.orders.index')   => route('home'),
            trans('breadcrumb.orders.participate'),
            $order->name
        ]
    ])
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="row">

            <div class="col-md-1"></div>

            {{-- Participate --}}
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header card-header-icon">
                        {{-- Title --}}
                        <h4 class="card-title row mt-0">
                            <strong class="col-md mt-4">
                                {!! config('icons.fastfood') !!} {{ $order->name }}
                            </strong>
                        </h4>
                    </div>

                    <hr class="mt-2">

                    {{-- Content --}}
                    <div class="card-body pt-0">
                        <form action="{{ route('menu.store') }}" method="POST">
                            @csrf
                            {{-- Order ID --}}
                            <input type="number" name="order_id" id="order_id" value="{{ $order->id }}" hidden>

                            {{-- Name --}}
                            <div class="form-group col pl-0 pr-3">
                                {{ Form::label('name', trans('forms.orders.participate.name'), ['class' => 'bmd-label-floating']) }}
            
                                {{ Form::text('name', null, [
                                    'class'     => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                    'value'     => old('name'),
                                    'minlength' => '5',
                                    'maxlength' => '128',
                                    'required',
                                    'autofocus'
                                ]) }}

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- Number --}}
                            <div class="form-group col px-0">
                                {{ Form::label('number', trans('forms.orders.participate.number'), ['class' => 'bmd-label-floating']) }}

                                <select name="number" id="number" class="form-control" required>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="form-group col pl-0 pr-3">
                                {{ Form::label('price', trans('forms.orders.participate.price'), ['class' => 'bmd-label-floating']) }}
            
                                {{ Form::text('price', null, [
                                    'class'     => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''),
                                    'value'     => old('price'),
                                    'minlenght' => '0',
                                    'max'       => '6',
                                    'required'
                                ]) }}

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>

                            {{-- Comment --}}
                            <div class="form-group col pl-0 pr-3">
                                {{ Form::label('comment', trans('forms.orders.participate.comment'), ['class' => 'bmd-label-floating']) }}
                                {{ Form::textarea('comment', null, [
                                    'class'         => 'form-control',
                                    'rows'          => '5',
                                    'minlenght'     => '0',
                                    'maxlenght'     => '255'
                                ]) }}
            
                                @if ($errors->has('comment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            {{-- Submit --}}
                            <div class="form-group row">
                                <button type="submit" class="btn btn-block btn-outline-success btn-round">
                                    {!! config('icons.shopping-cart') !!} &ensp; @lang('forms.orders.participate.submit')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Order informations | All menus --}}
            <div class="col-lg-6">
                {{-- Order informations --}}
                <div class="row">
                    <div class="col">
                        <div class="card">
                            {{-- Card Header --}}
                            @if(sizeof($order->menus) != 0 && (sizeof($order->menus) + 1 == $order->max_orders || sizeof($order->menus) + 2 == $order->max_orders))
                                <div class="card-header card-header-warning">
                            @else
                                <div class="card-header card-header-success">
                            @endif
                                {{-- Title --}}
                                <h4 class="card-title mt-0">
                                    <strong>
                                        <i class="fa fa-sm fa-info" aria-hidden="true" data-toggle="modal" data-target="#mysticModal02"></i> &ensp; @lang('page.orders.participate.title')
                                    </strong>
                                </h4>
                            </div>

                            {{-- Card Content --}}
                            <div class="card-body">
                                <dl class="row">
                                    {{-- Created by --}}
                                    <dt class="col-sm-4">
                                        {!! config('icons.profile-sm') !!} &ensp; @lang('page.orders.participate.created_by')
                                    </dt>
                                    <dd class="col-sm-8 text-muted">
                                        {{ $order->user->firstname }} {{ $order->user->surname}} ({{ $order->user->username }})
                                        &ensp;
                                        @if (file_exists(realpath(config('filesystems.avatar.path').$order->user->avatar)))
                                        <img class="rounded-circle" src="{{ asset(config('filesystems.avatar.path').$order->user->avatar) }}" title="{{ $order->user->firstname }} {{ $order->user->surname}} ({{ $order->user->username }})" width="26px" height="26px">
                                        @endif
                                    </dd>

                                    {{-- Deadline --}}
                                    <dt class="col-sm-4">
                                        {!! config('icons.time-sm') !!} &ensp; @lang('page.orders.participate.deadline')
                                    </dt>
                                    @if ($order->timeLeft_min <= 5)
                                    <dd class="col-sm-8 text-danger">

                                    @elseif($order->timeLeft_min <= 10)
                                    <dd class="col-sm-8 text-warning">

                                    @else
                                    <dd class="col-sm-8 text-success">
                                    @endif
                                        {{ $order->deadline }} @lang('page.orders.participate.time')
                                    </dd>
                                    
                                    {{-- Counter --}}
                                    <dt class="col-sm-4">
                                        {!! config('icons.people-sm') !!} &ensp; @lang('page.orders.participate.people')
                                    </dt>
                                    <dd class="col-sm-8">
                                        @if(sizeof($order->menus) != 0 && (sizeof($order->menus) + 1 == $order->max_orders || sizeof($order->menus) + 2 == $order->max_orders))
                                            <div class="text-warning">
                                        @else
                                            <div class="text-success">
                                        @endif
                                            {{ sizeof($order->menus) }} / {{ $order->max_orders }}
                                        </div>
                                    </dd>
                                    
                                    {{-- Minimum value --}}
                                    <dt class="col-sm-4">
                                        {!! config('icons.money-sm') !!} &ensp; @lang('page.orders.participate.minimum_value')
                                    </dt>
                                    @if ($order->minimum_value == 0)
                                    <dd class="col-sm-8 text-success">
                                        
                                    @elseif ($order->sum >= $order->minimum_value)
                                    <dd class="col-sm-8 text-success">
                                    
                                    @else
                                    <dd class="col-sm-8 text-warning">
                                    @endif
                                        {{ $order->minimum_value }} {{ config('app.currency') }}
                                    </dd>

                                    {{-- Site link --}}
                                    <dt class="col-sm-4">
                                        {!! config('icons.shopping-cart-sm') !!} &ensp; @lang('page.orders.participate.delivery_service')
                                    </dt>
                                    <dd class="col-sm-8 text-link">
                                        <a href="{{ $order->site_link }}" target="_blank">
                                            {{ $order->delivery_service }}
                                        </a>
                                    </dd>

                                    {{-- Manage --}}
                                    @if (Auth::user()->id == $order->user_id)
                                        <dt class="col-sm-4 mt-3">
                                            <form action="{{ route('manage.orders.index') }}" method="GET" role="search">
                                                {!! config('icons.settings-sm') !!}
            
                                                <input name="id" id="id" type="text" class="form-control" value="{{ $order->id }}" hidden>
                                                <button type="submit" class="btn btn-link text-primary p-0">
                                                    &ensp; @lang('page.orders.manage')
                                                </button>
                                            </form>
                                        </dt>
                                        <dd class="col-sm-8 text-link"></dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if (sizeof($order->menus) != 0)
                    {{-- All menus --}}
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                {{-- Card Header --}}
                                <div class="card-header text-dark bg-light">
                                    {{-- Title --}}
                                    <h4 class="card-title mt-0">
                                        <strong>
                                            {!! config('icons.shopping-cart-sm') !!} &ensp; @lang('page.orders.participate.other_participants')
                                        </strong>
                                    </h4>
                                </div>

                                {{-- Card Content --}}
                                <div class="card-body p-0">
                                    <table class="table table-sm text-center m-0 ">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="p-1">@lang('tables.orders.head.name')</th>
                                                <th class="p-1">@lang('tables.orders.head.menu')</th>
                                                <th class="p-1">@lang('tables.orders.head.price')</th>
                                                <th class="p-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->menus as $menu)
                                                @if (Auth::user()->id == $menu->user_id)
                                                <tr class="text-primary">
                                                @else
                                                <tr>
                                                @endif
                                                    <td class="p-1">{{ $menu->user->firstname }} {{ $menu->user->surname }}</td>
                                                    <td class="p-1">{{ $menu->name }}</td>
                                                    <td class="p-1">{{ $menu->price }} {{ config('app.currency') }}</td>
                                                    @if (Auth::user()->id == $menu->user_id)
                                                        <td class="p-1">
                                                            <form action="{{ route('manage.menus.index') }}" method="GET">
                                                                <input name="id" id="id" type="text" class="form-control" value="{{ $menu->id }}" hidden>
                                                                <button type="submit" class="btn btn-link p-1 m-0 text-primary">
                                                                    {!! config('icons.settings-sm') !!}
                                                                </button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            
                                            <tr>
                                                <td class="p-1"></td>
                                                <td class="p-1"></td>
                                                <th class="p-1 text-center"><strong>{{ $order->sum }} {{ config('app.currency') }}</strong></th>
                                                <td class="p-1"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div class="modal fade" id="mysticModal02" tabindex="-1" role="dialog" aria-labelledby="mysticModal02" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="mysticModal02">
                        @lang('page.mysticModal')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('img/mysticModal02.jpg') }}" title="I are programmer - I make computer beep boop beep beep boop">
                </div>
            </div>
        </div>
    </div>
@endsection
