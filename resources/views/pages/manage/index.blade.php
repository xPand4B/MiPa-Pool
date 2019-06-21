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
                            <th>@sortablelink('deliveryService',    trans('page.manage.index.tableHeads.deliveryService'))</th>
                            <th>@sortablelink('deadline',           trans('page.manage.index.tableHeads.deadline'))</th>
                            <th>@sortablelink('createdAt',          trans('page.manage.index.tableHeads.createdAt'))</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>
                                        <a href="{{ $order->site_link }}" class="link" target="_blank">
                                            {{ $order->delivery_service }}
                                        </a>
                                    </td>
                                    <td>{{ $order->deadline }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td class="pull-right">
                                        {{-- Show --}}
                                        <a href="#" class="btn btn-sm btn-round btn-info" title="{{ trans('page.manage.index.tableButtons.edit') }}">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="#" class="btn btn-sm btn-round btn-success" title="{{ trans('page.manage.index.tableButtons.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        
                                        {{-- Close --}}
                                        <a href="#" class="btn btn-sm btn-round btn-warning" title="{{ trans('page.manage.index.tableButtons.close') }}">
                                            <i class="fa fa-close"></i>
                                        </a>
        
                                        {{-- Delete --}}
                                        <a href="#" class="btn btn-sm btn-round btn-danger" title="{{ trans('page.manage.index.tableButtons.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr class="mb-5">
            
                {{ $orders->links('vendor.pagination.bootstrap-4') }}

            </div>
        </div>
    </div>
@endsection
