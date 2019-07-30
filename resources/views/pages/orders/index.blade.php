@extends('layouts.main')

@section('headline')
    @include('partials._breadcrumb', [
        'items' => [
            trans('breadcrumb.orders.index'),
        ]
    ])
@endsection

@section('content')
    <div class="col-md-10 offset-md-1 px-0">

        {{-- No orders --}}
        @if (sizeof($orders) == 0)
            <div class="card card-chart mb-5">
                {{-- Card Header --}}
                <div class="card-header card-header-icon">
                    {{-- User Icon --}}
                    <div class="card-icon p-0 bg-transparent">
                        @if (file_exists(realpath(config('filesystems.avatar.path').config('filesystems.avatar.default'))))
                            <img src="{{ asset(config('filesystems.avatar.path').config('filesystems.avatar.default')) }}" width="64px" height="64px">
                        @endif
                    </div>

                    {{-- Title --}}
                    <h4 class="card-title row mt-0">
                        <strong class="h2 col mt-4 text-center text-info">
                            @lang('page.orders.index.empty.title')
                        </strong>
                    </h4>
                </div>
                
                <hr class="mt-2">

                {{-- Card Content --}}
                <div class="card-content">
                    <div class="container">
                        <div class="h3 text-center">
                            @lang('page.orders.index.empty.message')
                        </div>
                    </div>
                </div>
            </div>
        
        {{-- Orders found --}}
        @else
            @foreach ($orders as $order)
                @if (Auth::user()->id == $order->user_id)
                <div class="card card-chart border border-primary mb-5">    
                @else
                <div class="card card-chart mb-5">
                @endif
                
                    {{-- Card Header --}}
                    <div class="card-header card-header-icon">
                        {{-- User Avatar --}}
                        <div class="card-icon p-0 bg-transparent">
                            @if (file_exists(realpath(config('filesystems.avatar.path').$order->user->avatar)))
                            <img 
                                class="rounded-circle"
                                src="{{ asset(config('filesystems.avatar.path').$order->user->avatar) }}"
                                title="{{ $order->user->firstname }} {{ $order->user->surname}} ({{ $order->user->username }})" 
                                width="64px"
                                height="64px">
                            @endif
                        </div>

                        {{-- Title --}}
                        <h4 class="card-title row mt-0">
                            <strong class="col-md-8 mt-4">
                                <div class="text-dark">
                                    {{ $order->name }}
                                </div>

                                <small>
                                    <u>
                                        <a href="{{ $order->site_link }}" target="_blank" class="text-muted">
                                            {{ $order->delivery_service }}
                                        </a>
                                    </u>
                                </small>
                            </strong>

                            <div class="col-md-4 mt-2">
                                @if (sizeof($order->menus) == $order->max_orders)
                                    <a href="#" class="btn btn-block btn-round disabled" disabled hidden>

                                @elseif(sizeof($order->menus) != 0 && (sizeof($order->menus) + 1 == $order->max_orders || sizeof($order->menus) + 2 == $order->max_orders))
                                    <a href="{{ route('menu.create', ['order' => $order]) }}" class="btn btn-block btn-warning btn-round">

                                @else
                                    <a href="{{ route('menu.create', ['order' => $order]) }}" class="btn btn-block btn-success btn-round">
                                @endif

                                    {!! config('icons.participate') !!}
                                    @lang('tables.orders.participate')
                                </a>
                            </div>
                        </h4>
                    </div>  
                    
                    {{-- Card Content --}}
                    <div class="card-content mt-2">
                        <div class="container-fluid p-0">
                            @if ($order->menus->isNotEmpty())
                                <table class="table table-sm table-shopping text-center m-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="p-1">@lang('tables.orders.head.name')</th>
                                            <th class="p-1">@lang('tables.orders.head.menu')</th>
                                            <th class="p-1">@lang('tables.orders.head.number')</th>
                                            <th class="p-1">@lang('tables.orders.head.comment')</th>
                                            <th class="p-1">@lang('tables.orders.head.price')</th>
                                            <th class="p-1"></th>
                                            <th class="p-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->menus as $menu)
                                            @if (Auth::user()->id == $menu->user_id)
                                                @if ($menu->payed)
                                                    <tr id="row-menu-{{ $menu->id }}" class="text-primary" style="text-decoration: line-through">
                                                @else
                                                    <tr id="row-menu-{{ $menu->id }}" class="text-primary">
                                                @endif
                                            @else
                                                @if ($menu->payed)
                                                    <tr id="row-menu-{{ $menu->id }}" class="text-muted" style="text-decoration: line-through">
                                                @else
                                                    <tr id="row-menu-{{ $menu->id }}">
                                                @endif
                                                
                                            @endif

                                                <td class="p-1">{{ $menu->user->firstname }} {{ $menu->user->surname }}</td>
                                                <td class="p-1">{{ $menu->name }}</td>
                                                <td class="p-1">{{ $menu->number }}</td>
                                                <td class="p-1">{{ $menu->comment }}</td>
                                                <td class="p-1">{{ $menu->price }} {{ config('app.currency') }}</td>

                                                @if (Auth::user()->id == $menu->order->user_id)
                                                    <td class="p-1">
                                                        <div class="form-check m-0">
                                                            <label class="form-check-label">
                                                                @if ($menu->payed)
                                                                    <input class="form-check-input form-sm" type="checkbox" value="{{ $menu->id }}" id="payed-menu-{{ $menu->id }}" onclick="TogglePayed(this, <?=$menu->id;?>)" checked>
                                                                @else
                                                                    <input class="form-check-input form-sm" type="checkbox" value="{{ $menu->id }}" id="payed-menu-{{ $menu->id }}" onclick="TogglePayed(this, <?=$menu->id;?>)">
                                                                @endif
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                @endif

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
                                            <td class="p-1"></td>
                                            <td class="p-1"></td>
                                            <th class="p-1 text-center"><strong>{{ $order->sum }} {{ config('app.currency') }}</strong></th>
                                            <td class="p-1"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            @else
                                <div class="text-center">
                                    <h5 class="text-danger"><strong>@lang('tables.orders.empty')</strong></h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <hr class="mt-2 mb-0">

                    {{-- Card Footer --}}
                    <div class="card-footer">
                        {{-- Deadline --}}
                        <div class="col-md">
                            @if ($order->timeLeft_min <= 5)
                            <div class="stats text-danger">

                            @elseif($order->timeLeft_min <= 10)
                            <div class="stats text-warning">

                            @else
                            <div class="stats text-success">
                            @endif

                                {!! config('icons.time') !!} {{ $order->timeLeft }}
                            </div>
                        </div>

                        {{-- Creator --}}
                        <div class="col-md text-center">
                            <div class="stats text-primary">

                                @if (Auth::user()->id == $order->user_id)
                                    <form action="{{ route('manage.orders.index') }}" method="GET">
                                        <input name="id" id="id" type="text" class="form-control" value="{{ $order->id }}" hidden>
                                        <button type="submit" class="btn btn-link p-0 text-primary text-capitalize">
                                            {!! config('icons.settings-sm') !!} @lang('page.orders.manage')
                                        </button>
                                    </form>
                                @else
                                    {!! config('icons.profile') !!} {{ $order->user->fullname }} ({{ $order->user->username }})
                                @endif

                            </div>
                        </div>

                        {{-- Participants --}}
                        <div class="col-md text-right">
                            @if (sizeof($order->menus) == $order->max_orders)
                                <div class="stats text-danger">
                            @elseif(sizeof($order->menus) != 0 && (sizeof($order->menus) + 1 == $order->max_orders || sizeof($order->menus) + 2 == $order->max_orders))
                                <div class="stats text-warning">
                            @else
                                <div class="stats text-success">
                            @endif

                                {!! config('icons.checked') !!} {{ sizeof($order->menus) }}/{{ $order->max_orders }} @lang('tables.orders.footer.people_count')
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

            <hr class="mb-5">
            
            {{ $orders->links('vendor.pagination.bootstrap-4') }}

        @endif
    </div>
@endsection

@section('javascript')
    @include('partials._togglePayed')
@endsection
