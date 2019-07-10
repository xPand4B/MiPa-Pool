@extends('layouts.main')

@section('headline')
    @include('partials._breadcrumb', [
        'items' => [
            trans('page.manage.breadcrumb.index'),
            trans('page.manage.breadcrumb.orders'),
        ]
    ])
@endsection

@section('content')
    <div class="col-md-10 offset-md-1 px-0">

        {{-- Card --}}
        <div class="card">

            {{-- Header --}}
            <div class="card-header card-header-success"></div>

            {{-- Header --}}
            <div class="card-header card-header-transparent card-header-icon mx-5">

                {{-- Title --}}
                <h4 class="card-title row mt-4">
                    <strong class="col">
                        @lang('page.manage.headline.orders')
                    </strong>

                    <div class="col-md-4">
                        <div class="input-group no-border">
                            <input type="text" value="{{ isset($selected) ? $selected : '' }}" id="searchbar-management" class="form-control" placeholder="{{ trans('menu.top.search') }}">
                        </div>
                    </div>

                </h4>
            </div>

            <hr>

            {{-- Content --}}
            <div class="card-body p-0">
                <div class="container-fluid table-responsive-sm p-0">
                    <table class="table table-sm table-hover" id="table-management">
                        <thead>
                            <th>@sortablelink('name',               trans('page.manage.tableHeads.name'))</th>
                            <th>@sortablelink('delivery_service',   trans('page.manage.tableHeads.deliveryService'))</th>
                            <th>@sortablelink('deadline',           trans('page.manage.tableHeads.deadline'))</th>
                            <th>@sortablelink('created_at',         trans('page.manage.tableHeads.createdAt'))</th>
                            <th>@sortablelink('updated_at',         trans('page.manage.tableHeads.updatedAt'))</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @if ($order->closed)
                                <tr class="table-danger">
                                @else
                                <tr class="table-success">
                                @endif
                                    <td style="display:none">id:{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>
                                        <a href="{{ $order->site_link }}" class="link" target="_blank">
                                            {{ $order->delivery_service }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ date('d.m.Y - H:i', strtotime($order->deadline)) }} @lang('page.manage.edit.form.time')
                                    </td>
                                    <td>
                                        {{ date('d.m.Y - H:i', strtotime($order->created_at)) }} @lang('page.manage.edit.form.time')
                                    </td>
                                    <td>
                                        @if ($order->created_at != $order->updated_at)
                                            {{ date('d.m.Y - H:i', strtotime($order->updated_at)) }} @lang('page.manage.edit.form.time')
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row pull-right">
                                                                                    
                                            {{-- Edit --}}
                                            @if (! $order->closed)
                                                <div class="col p-0 text-center">
                                                    <button type="button" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.tableButtons.edit') }}" data-toggle="modal" data-target="#orders.edit.{{ $order->id }}">
                                                        {!! config('icons.edit') !!}
                                                    </button>
                                                </div>
                                            @endif

                                            {{-- Close --}}
                                            @if (! $order->closed)
                                                <div class="col p-0 text-center">
                                                    <a href="{{ route('orders.close', $order) }}" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.tableButtons.close') }}">
                                                        {!! config('icons.close') !!}
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="col p-0 text-center">
                                                <button type="button" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.tableButtons.show') }}" data-toggle="modal" data-target="#orders.show.{{ $order->id }}">
                                                    {!! config('icons.show') !!}
                                                </button>
                                            </div>
            
                                            {{-- Delete --}}
                                            @if (! $order->closed)
                                                <div class="col p-0 text-center">
                                                    {!! Form::open(['route' => ['orders.destroy', $order], 'method' => 'DELETE']) !!}
                                                        <button type="submit" class="btn btn-sm btn-link bg-transparent text-danger" title="{{ trans('page.manage.tableButtons.delete') }}">
                                                            {!! config('icons.delete') !!}
                                                        </button>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr class="mb-5">
            
                {!! $orders->appends(\Request::except('page'))->render() !!}
            </div>

            @include('pages.manage.orders.edit', [ 'orders' => $orders, 'timesteps' => $timesteps])
            @include('pages.manage.orders.show', [ 'orders' => $orders ])

        </div>
    </div>
@endsection

@include('partials._livesearch')
