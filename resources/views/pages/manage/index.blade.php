@extends('layouts.main')

@section('title', trans('page.manage.title'))

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item active" aria-current="page">@lang('page.manage.breadcrumb.index')</li>
        </ol>
    </nav>
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
                <div class="card-header card-header-transparent card-header-icon">

                    {{-- Title --}}
                    <h4 class="card-title row mt-4">
                        <strong class="col">
                            @lang('page.manage.index.headline')
                        </strong>

                        <div class="col-md-4">
                            <form method="POST" action="#" class="justify-content-center">
                                @csrf
                                <div class="input-group no-border">
                                    <input type="text" value="" class="form-control" placeholder="{{ trans('menu.top.search') }}">
                                    <button type="submit" class="btn btn-white btn-round btn-just-icon" hidden></button>
                                </div>
                            </form>
                        </div>

                    </h4>
                </div>


                <hr>

                {{-- Content --}}
                <div class="card-body p-0">
                    <div class="container-fluid table-responsive-sm">
                        <table class="table table-sm table-hover ">
                            <thead>
                                <th>@sortablelink('name',               trans('page.manage.index.tableHeads.name'))</th>
                                <th>@sortablelink('delivery_service',   trans('page.manage.index.tableHeads.deliveryService'))</th>
                                <th>@sortablelink('deadline',           trans('page.manage.index.tableHeads.deadline'))</th>
                                <th>@sortablelink('created_at',         trans('page.manage.index.tableHeads.createdAt'))</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr onclick="window.location.href='{{ route('manage.show', $order) }}'" title="{{ trans('page.manage.index.viewOrder') }}" style="cursor: pointer;">
                                    <td>{{ $order->name }}</td>
                                    <td onclick="" title="" style="cursor: default;">
                                        <a href="{{ $order->site_link }}" class="link" target="_blank">
                                            {{ $order->delivery_service }}
                                        </a>
                                    </td>
                                    <td>{{ $order->deadline }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <div class="row pull-right">
                                                                                    
                                            {{-- Edit --}}
                                            <a href="{{ route('manage.edit', $order) }}" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.index.tableButtons.edit') }}">
                                                {!! config('icons.edit') !!}
                                            </a>
            
                                            {{-- Delete --}}
                                            {!! Form::open(['route' => ['manage.destroy', $order], 'method' => 'DELETE']) !!}
                                            <button type="submit" class="btn btn-sm btn-link bg-transparent text-danger" title="{{ trans('page.manage.index.tableButtons.delete') }}">
                                                {!! config('icons.delete') !!}
                                            </button>
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
            @endif

        </div>
    </div>
@endsection
