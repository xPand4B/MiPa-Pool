@extends('layouts.main')

@section('title', $order->name)

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info">@lang('page.orders.breadcrumb.index')</a></li>
            <li class="breadcrumb-item">@lang('page.orders.breadcrumb.participate')</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $order->name }}</li>
        </ol>
    </nav>
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
                            <strong class="col-md-8 mt-4">
                                <i class="fa fa-cutlery" aria-hidden="true"></i> {{ $order->name }}
                            </strong>
                        </h4>
                    </div>

                    <hr class="mt-2">

                    {{-- Content --}}
                    <div class="card-body pt-0">
                        <form action="{{ route('order.participate.add') }}" method="POST">
                            @csrf
                            {{-- Order ID --}}
                            <input type="number" name="order_id" id="order_id" value="{{ $order->id }}" hidden>

                            {{-- Name --}}
                            <div class="form-group col pl-0 pr-3">
                                {{ Form::label('name', trans('page.orders.participate.form.name'), ['class' => 'bmd-label-floating']) }}
            
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
                                {{ Form::label('number', trans('page.orders.participate.form.number'), ['class' => 'bmd-label-floating']) }}

                                <select name="number" id="number" class="form-control" required>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="form-group col pl-0 pr-3">
                                {{ Form::label('price', trans('page.orders.participate.form.price'), ['class' => 'bmd-label-floating']) }}
            
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
                                {{ Form::label('comment', trans('page.orders.participate.form.comment'), ['class' => 'bmd-label-floating']) }}
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
                                    <i class="fa fa-shopping-cart"></i> &ensp; @lang('page.orders.participate.form.submit')
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
                                        <i class="fa fa-sm fa-user" aria-hidden="true"></i> &ensp; @lang('page.orders.participate.created_by')
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
                                        <i class="fa fa-sm fa-clock-o" aria-hidden="true"></i> &ensp; @lang('page.orders.participate.deadline')
                                    </dt>
                                    <dd class="col-sm-8 text-muted">
                                        {{ date("H:i", strtotime($order->deadline)) }} @lang('page.orders.participate.time')
                                    </dd>
                                    
                                    {{-- Counter --}}
                                    <dt class="col-sm-4">
                                        <i class="fa fa-sm fa-users" aria-hidden="true"></i> &ensp; @lang('page.orders.participate.people')
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
                                    
                                    {{-- Site link --}}
                                    <dt class="col-sm-4">
                                        <i class="fa fa-sm fa-shopping-cart" aria-hidden="true"></i> &ensp; @lang('page.orders.participate.delivery_service')
                                    </dt>
                                    <dd class="col-sm-8 text-link">
                                        <a href="{{ $order->site_link }}">
                                            {{ $order->delivery_service }}
                                        </a>
                                    </dd>
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
                                            <i class="fa fa-sm fa-shopping-cart" aria-hidden="true"></i> &ensp; @lang('page.orders.participate.other_participants')
                                        </strong>
                                    </h4>
                                </div>

                                {{-- Card Content --}}
                                <div class="card-body p-0">
                                    <table class="table table-sm text-center m-0 ">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="p-1">@lang('table.orders.head.name')</th>
                                                <th class="p-1">@lang('table.orders.head.menu')</th>
                                                <th class="p-1">@lang('table.orders.head.price')</th>
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
                                                    <td class="p-1">{{ $menu->menu }}</td>
                                                    <td class="p-1">{{ $menu->price }} €</td>
                                                </tr>
                                            @endforeach
                                            
                                            <tr>
                                                <td class="p-1"></td>
                                                <td class="p-1"></td>
                                                <th class="p-1 text-center"><strong>{{ $order->sum }} €</strong></th>
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
