@extends('layouts.main')

@section('title', trans('page.manage.title'))

@section('headline')
    @include('partials._breadcrumb', [
        'items' => [
            trans('page.manage.breadcrumb.index'),
        ]
    ])
@endsection

@section('content')
    <div class="col-md-10 offset-md-1 px-0">

        {{-- Card --}}
        <div class="card">

            {{-- Header --}}
            <div class="card-header card-header-success"></div>

            @if (sizeof($orders) == 0)
                {{-- Header --}}
                <div class="card-header card-header-transparent card-header-icon">
                        {{-- Title --}}
                    <h4 class="card-title row mt-0">
                        <strong class="h2 col mt-4 text-center text-info">
                            @lang('page.manage.empty.title')
                        </strong>
                    </h4>
                </div>

                <hr class="mt-2">

                {{-- Card Content --}}
                <div class="card-content">
                    <div class="container">
                        <div class="h3 text-center">
                            @lang('page.manage.empty.message')
                        </div>
                    </div>
                </div>

            @else
                {{-- Header --}}
                <div class="card-header card-header-transparent card-header-icon mx-5">

                    {{-- Title --}}
                    <h4 class="card-title row mt-4">
                        <strong class="col">
                            @lang('page.manage.index.headline')
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
                                <th>@sortablelink('name',               trans('page.manage.index.tableHeads.name'))</th>
                                <th>@sortablelink('delivery_service',   trans('page.manage.index.tableHeads.deliveryService'))</th>
                                <th>@sortablelink('deadline',           trans('page.manage.index.tableHeads.deadline'))</th>
                                <th>@sortablelink('created_at',         trans('page.manage.index.tableHeads.createdAt'))</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @if ($order->closed)
                                    <tr class="table-danger">
                                    @else
                                    <tr class="table-success">
                                    @endif
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
                                            <div class="row pull-right">
                                                                                        
                                                {{-- Edit --}}
                                                @if (! $order->closed)
                                                    <div class="col">
                                                        <button type="button" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.index.tableButtons.edit') }}" data-toggle="modal" data-target="#orders.edit.{{ $order->id }}">
                                                            {!! config('icons.edit') !!}
                                                        </button>
                                                    </div>
                                                @endif

                                                {{-- Close --}}
                                                @if (! $order->closed)
                                                    <div class="col">
                                                        <a href="{{ route('orders.close', $order) }}" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.index.tableButtons.close') }}">
                                                            {!! config('icons.close') !!}
                                                        </a>
                                                    </div>
                                                @endif

                                                <div class="col">
                                                    <button type="button" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.index.tableButtons.show') }}" data-toggle="modal" data-target="#orders.show.{{ $order->id }}">
                                                        {!! config('icons.show') !!}
                                                    </button>
                                                </div>
                
                                                {{-- Delete --}}
                                                {!! Form::open(['route' => ['orders.destroy', $order], 'method' => 'DELETE']) !!}
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-sm btn-link bg-transparent text-danger" title="{{ trans('page.manage.index.tableButtons.delete') }}">
                                                            {!! config('icons.delete') !!}
                                                        </button>
                                                    </div>
                                                {!! Form::close() !!}

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

                @include('pages.manage.edit', [ 'orders' => $orders, 'timesteps' => $timesteps])
                @include('pages.manage.show', [ 'orders' => $orders ])
            @endif
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            // Input is not empty on page load
            if($("#searchbar-management").val()){
                var value = $("#searchbar-management").val().toLowerCase().trim();

                $("#table-management tr").each(function (index) {
                    if (!index)
                        return;

                    $(this).find("td").each(function () {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(value) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                });
            }                

            // Input is empty on page load
            $("#searchbar-management").keyup(function () {
                var value = this.value.toLowerCase().trim();

                $("#table-management tr").each(function (index) {
                    if (!index)
                        return;

                    $(this).find("td").each(function () {
                        var id = $(this).text().toLowerCase().trim();
                        var not_found = (id.indexOf(value) == -1);
                        $(this).closest('tr').toggle(!not_found);
                        return not_found;
                    });
                });
            });
        });
    </script>
@endsection
