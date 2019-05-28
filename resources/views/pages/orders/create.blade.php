@extends('layouts.main')

@section('title', trans('page.orders.title'))

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info">@lang('page.orders.breadcrumb.index')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('page.orders.breadcrumb.create')</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">

            {{-- Create Order --}}
            <div class="col-lg-6 offset-md-3">
                <div class="card">
                    {{-- Card Header --}}
                    <div class="card-header card-header-transparent card-header-icon">
                        <div class="card-icon p-0 m-0 bg-transparent row text-center" style="float: none">
                            
                            {{-- Lieferheld --}}
                            <div class="col">
                                <img src="{{ asset('img/lieferheld_400x400.png') }}" title="" width="82px" height="82px" style="border-radius: 41px" data-toggle="modal" data-target="#mysticModal01">
                            </div>

                            {{-- Pizza.de --}}
                            <div class="col">
                                <img src="{{ asset('img/pizza.de_1200x1200.png') }}" title="" width="82px" height="82px" style="border-radius: 41px" data-toggle="modal" data-target="#mysticModal01">
                            </div>

                            {{-- Lieferando --}}
                            <div class="col">
                                <img src="{{ asset('img/lieferando_512x512.png') }}" title="" width="82px" height="82px" style="border-radius: 41px" data-toggle="modal" data-target="#mysticModal01">
                            </div>
                        </div>
                    </div>
                    
                    {{-- Card Content --}}
                    <div class="card-body">
                        <form method="POST" action="{{ route('order.store') }}">
                            @csrf
                            {{-- Order Name --}}
                            <div class="form-group is-focused">
                                <label for="order_name" class="bmd-label-floating">
                                    @lang('page.orders.create.form.order_name')
                                </label>
            
                                <input id="order_name" type="text" class="form-control{{ $errors->has('order_name') ? ' is-invalid' : '' }}" name="order_name" value="{{ old('order_name') }}" required autofocus>
            
                                @if ($errors->has('order_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('order_name') }}</strong>
                                    </span>
                                @endif
                            </div>
            
                            {{-- Deadline | Max Orders | Minimum order value --}}
                            <div class="form-row" style="padding-left: 5px">
                                {{-- Deadline --}}
                                <div class="form-group col pl-0 pr-3">
                                    <label for="deadline" class="bmd-label-floating">
                                        @lang('page.orders.create.form.deadline')
                                    </label>
                                    <select name="deadline" id="deadline" class="form-control">
                                        @for ($i = 0; $i < sizeof($timesteps); $i++)
                                            @if ($i == 0)
                                                <option value="{{ $timesteps[$i] }}" selected>{{ $timesteps[$i] }} @lang('page.orders.create.form.time')</option>
                                            @else
                                                <option value="{{ $timesteps[$i] }}">{{ $timesteps[$i] }} @lang('page.orders.create.form.time')</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>

                                {{-- Max Orders --}}
                                <div class="form-group col px-0 pr-3">
                                    <label for="max_orders" class="bmd-label-floating">
                                        @lang('page.orders.create.form.max_orders')
                                    </label>
                                    <select name="max_orders" id="max_orders" class="form-control" required>
                                        @for ($i = 2; $i <= 20; $i++)
                                            @if ($i == 2)
                                                <option value="{{ $i }}" selected>{{ $i }} @lang('page.orders.create.form.people')</option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }} @lang('page.orders.create.form.people')</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>

                                {{-- Minimun order value --}}
                                <div class="form-group col">
                                    <label for="minimum_order_value" class="bmd-label-floating">
                                        @lang('page.orders.create.form.minimum_order_value')
                                    </label>

                                    <select name="minimum_order_value" id="minimum_order_value" class="form-control" required>
                                        @for ($i = 0; $i <= 20; $i++)
                                        <option value="{{ $i }}">{{ $i }} @lang('page.orders.create.form.currency')</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
            
                            {{-- Delivery Service | Site Link --}}
                            <div class="form-row" style="padding-left: 5px">
                                {{-- Delivery Service --}}
                                <div class="form-group col pl-0 pr-3">
                                    <label for="delivery_service" class="bmd-label-floating">
                                        @lang('page.orders.create.form.delivery_service')
                                    </label>
            
                                    <input id="delivery_service" type="text" class="form-control{{ $errors->has('delivery_service') ? ' is-invalid' : '' }}" name="delivery_service" value="{{ old('delivery_service') }}" required>
            
                                    @if ($errors->has('delivery_service'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('delivery_service') }}</strong>
                                        </span>
                                    @endif
                                </div>
            
                                {{-- Site Link --}}
                                <div class="form-group col px-0">
                                    <label for="site_link" class="bmd-label-floating">
                                        @lang('page.orders.create.form.site_link')
                                    </label>
            
                                    <input id="site_link" type="text" class="form-control{{ $errors->has('site_link') ? ' is-invalid' : '' }}" name="site_link" value="{{ old('site_link') }}" required>
            
                                    @if ($errors->has('site_link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('site_link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="form-group row">
                                <button type="submit" class="btn btn-block btn-success btn-round">
                                    <i class="fa fa-shopping-cart"></i> &ensp; @lang('page.orders.create.form.submit')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <div class="modal fade" id="mysticModal01" tabindex="-1" role="dialog" aria-labelledby="mysticModal01" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="mysticModal01">
                        @lang('page.mysticModal')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-9">
                        <strong>
                        ⠀⠰⡿⠿⠛⠛⠻⠿⣷<br>⠀⠀⠀⠀⠀⠀⣀⣄⡀⠀⠀⠀⠀⢀⣀⣀⣤⣄⣀⡀<br>⠀⠀⠀⠀⠀⢸⣿⣿⣷⠀⠀⠀⠀⠛⠛⣿⣿⣿⡛⠿⠷<br>⠀⠀⠀⠀⠀⠘⠿⠿⠋⠀⠀⠀⠀⠀⠀⣿⣿⣿⠇<br>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠉⠁<br>
                        </strong>
                    </div>
                    <div class="col-3">
                        <strong>
                            <br>{\__/}<br>(●_●)<br>( >🌮<br>Want a taco?
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
