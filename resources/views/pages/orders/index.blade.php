@extends('layouts.main')

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            {{-- <li class="breadcrumb-item"><a href="{{ url('dashboard/posts') }}" class="text-danger">Posts</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page">@lang('page.orders.breadcrumb.index')</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="col-md-10 offset-md-1">
        {{-- No orders --}}
        @if (sizeof($orders) == 0)
            <div class="card card-chart mb-5">
                {{-- Card Header --}}
                <div class="card-header card-header-icon">
                    {{-- User Icon --}}
                    <div class="card-icon p-0 bg-transparent">
                        <img src="{{ asset('storage/avatars/user.svg') }}" width="64px" height="64px">
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
                <div class="card-content ml-4">
                    <div class="container-responsive">
                        <div class="h3 text-center">
                            @lang('page.orders.index.empty.message')
                        </div>
                    </div>
                </div>
            </div>
        
        {{-- Orders found --}}
        @else
            @foreach ($orders as $order)
                <div class="card card-chart mb-5">
                    {{-- Card Header --}}
                    <div class="card-header card-header-icon">
                        {{-- User Icon --}}
                        <div class="card-icon p-0 bg-transparent">
                            <img class="rounded-circle" src="{{ asset('storage/avatars/'.$order->user->avatar) }}" title="{{ $order->user->firstname }} {{ $order->user->surname}} ({{ $order->user->username }})" width="64px" height="64px">
                        </div>

                        {{-- Title --}}
                        <h4 class="card-title row mt-0">
                            <strong class="col-md-8 mt-4">
                                {{ $order->name }}
                            </strong>

                            @if (sizeof($order->menus) == $order->max_orders)
                                <div class="col-md-4 mt-2">
                                    <a href="#" class="btn btn-block btn-round disabled" aria-disabled="false">
                                        <i class="fa fa-cart-plus"></i>
                                        @lang('table.orders.participate')
                                    </a>
                                </div>

                            @elseif(sizeof($order->menus) != 0 && (sizeof($order->menus) + 1 == $order->max_orders || sizeof($order->menus) + 2 == $order->max_orders))
                                <div class="col-md-4 mt-2">
                                    <a href="{{ route('order.participate', ['id' => $order->id]) }}" class="btn btn-block btn-warning btn-round">
                                        <i class="fa fa-cart-plus"></i>
                                        @lang('table.orders.participate')
                                    </a>
                                </div>

                            @else
                                <div class="col-md-4 mt-2">
                                    <a href="{{ route('order.participate', ['id' => $order->id]) }}" class="btn btn-block btn-success btn-round">
                                        <i class="fa fa-cart-plus"></i>
                                        @lang('table.orders.participate')
                                    </a>
                                </div>
                            @endif

                        </h4>
                    </div>  

                    <hr class="mt-2">
                    
                    {{-- Card Content --}}
                    <div class="card-content">
                        <div class="container responsive">
                            @php
                                $sum   = 0;
                                $count = 0;
                            @endphp

                            @if ($order->menus->isNotEmpty())
                                <table class="table table-responsive-sm table-sm table-hover table-shopping text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            {{-- <th class="p-1">@lang('table.orders.head.count')</th> --}}
                                            <th class="p-1">@lang('table.orders.head.name')</th>
                                            <th class="p-1">@lang('table.orders.head.menu')</th>
                                            <th class="p-1">@lang('table.orders.head.number')</th>
                                            <th class="p-1">@lang('table.orders.head.comment')</th>
                                            <th class="p-1">@lang('table.orders.head.price')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->menus as $menu)
                                            @php
                                                $sum += $menu->price;

                                                if($sum < 10){
                                                    $sum = '0'.$sum;
                                                }
                                                
                                                if(strlen($sum) == 4){
                                                    $sum = $sum.'0';
                                                }

                                                if(strlen($sum) == 2){
                                                    $sum = $sum.'.00';
                                                }

                                                $count++;
                                            @endphp
                                            <tr>
                                                {{-- <td class="p-1">{{ $count }}</td> --}}
                                                <td class="p-1">{{ $menu->user->firstname }} {{ $menu->user->surname }}</td>
                                                <td class="p-1">{{ $menu->menu }}</td>
                                                <td class="p-1">{{ $menu->number }}</td>
                                                <td class="p-1">{{ $menu->comment }}</td>
                                                <td class="p-1">{{ str_replace('.', ',', $menu->price) }} €</td>
                                            </tr>
                                        @endforeach

                                        <tr class="table-light">
                                            {{-- <td class="p-1"></td> --}}
                                            <td class="p-1"></td>
                                            <td class="p-1"></td>
                                            <td class="p-1"></td>
                                            <td class="p-1"></td>
                                            <th class="p-1">{{ str_replace('.', ',', $sum) }} €</th>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            @else
                                <div class="text-center">
                                    <h5 class="text-danger"><strong>@lang('table.orders.empty')</strong></h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <hr class="mb-0">

                    {{-- Card Footer --}}
                    <div class="card-footer">
                        <div class="col-md">
                            <div class="stats text-danger">
                                <i class="material-icons">access_time</i> 4 @lang('table.orders.footer.time_left')
                            </div>
                        </div>
                        <div class="col-md text-center">
                            <div class="stats">
                                <i class="material-icons pl-1">person</i> {{ $order->user->firstname }} {{ $order->user->surname}} ({{ $order->user->username }})
                            </div>
                        </div>
                        <div class="col-md text-right">
                            @if ($count == $order->max_orders)
                                <div class="stats text-danger">
                                    <i class="material-icons">done</i> {{ !empty($count) ? $count : 0 }}/{{ $order->max_orders }} @lang('table.orders.footer.people_count')
                                </div>
                                
                            @elseif($count != 0 && ($count + 1 == $order->max_orders || $count + 1 == $order->max_orders))
                                <div class="stats text-warning">
                                    <i class="material-icons">done</i> {{ !empty($count) ? $count : 0 }}/{{ $order->max_orders }} @lang('table.orders.footer.people_count')
                                </div>

                            @else
                                <div class="stats text-success">
                                    <i class="material-icons">done</i> {{ !empty($count) ? $count : 0 }}/{{ $order->max_orders }} @lang('table.orders.footer.people_count')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>{{-- end Card --}}
            @endforeach

            <hr class="mb-5">
            
            {{ $orders->links('vendor.pagination.bootstrap-4') }}

        @endif
    </div>

@endsection
