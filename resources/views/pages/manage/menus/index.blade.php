@extends('layouts.main')

@section('headline')
    @include('partials._breadcrumb', [
        'items' => [
            trans('page.manage.breadcrumb.index'),
            trans('page.manage.breadcrumb.menus'),
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
                        @lang('page.manage.headline.menus')
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
                            <th>@sortablelink('name',       trans('page.manage.tableHeads.name'))</th>
                            <th>@sortablelink('number',     trans('page.manage.tableHeads.number'))</th>
                            <th>@sortablelink('price',      trans('page.manage.tableHeads.price'))</th>
                            <th>@sortablelink('created_at', trans('page.manage.tableHeads.createdAt'))</th>
                            <th>@sortablelink('updated_at', trans('page.manage.tableHeads.updatedAt'))</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                @if ($menu->order->closed)
                                <tr class="table-danger">
                                @else
                                <tr class="table-success">
                                @endif
                                    <td style="display:none">id:{{ $menu->id }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->number }}</td>
                                    <td>{{ $menu->price }} {{ config('app.currency') }}</td>
                                    <td>
                                        {{ date('d.m.Y - H:i', strtotime($menu->created_at)) }} @lang('page.manage.edit.form.time')
                                    </td>
                                    <td>
                                        @if ($menu->created_at != $menu->updated_at)
                                            {{ date('d.m.Y - H:i', strtotime($menu->updated_at)) }} @lang('page.manage.edit.form.time')
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row pull-right">
                                                                                    
                                            {{-- Edit --}}
                                            @if (! false)
                                                <div class="col p-0 text-center">
                                                    <button type="button" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.tableButtons.edit') }}" data-toggle="modal" data-target="#menus.edit.{{ $menu->id }}">
                                                        {!! config('icons.edit') !!}
                                                    </button>
                                                </div>
                                            @endif

                                            {{-- Show --}}
                                            <div class="col p-0 text-center">
                                                <button type="button" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('page.manage.tableButtons.show') }}" data-toggle="modal" data-target="#menus.show.{{ $menu->id }}">
                                                    {!! config('icons.show') !!}
                                                </button>
                                            </div>
            
                                            {{-- Delete --}}
                                            <div class="col p-0 text-center">
                                                {!! Form::open(['route' => ['menu.destroy', $menu], 'method' => 'DELETE']) !!}
                                                    <button type="submit" class="btn btn-sm btn-link bg-transparent text-danger" title="{{ trans('page.manage.tableButtons.delete') }}">
                                                        {!! config('icons.delete') !!}
                                                    </button>
                                                {!! Form::close() !!}
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr class="mb-5">
            
                {!! $menus->appends(\Request::except('page'))->render() !!}
            </div>

            @include('pages.manage.menus.edit',    [ 'menus' => $menus ])
            @include('pages.manage.menus.show',    [ 'menus' => $menus ])
            
        </div>
    </div>
@endsection

@include('partials._livesearch')
