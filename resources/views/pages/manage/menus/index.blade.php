@extends('layouts.main')

@section('headline')
    @include('partials._breadcrumb', [
        'items' => [
            trans('breadcrumb.management.index'),
            trans('breadcrumb.management.menus'),
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
                            <th>@sortablelink('name',       trans('tables.management.head.name'))</th>
                            <th class="text-center">@sortablelink('number',     trans('tables.management.head.number'))</th>
                            <th class="text-center">@sortablelink('price',      trans('tables.management.head.price'))</th>
                            <th class="text-center">@sortablelink('created_at', trans('tables.management.head.createdAt'))</th>
                            <th class="text-center">@sortablelink('updated_at', trans('tables.management.head.updatedAt'))</th>
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
                                    <td class="text-center">{{ $menu->number }}</td>
                                    <td class="text-center">{{ $menu->price }} {{ config('app.currency') }}</td>
                                    <td class="text-center">
                                        {{ date('d.m.Y', strtotime($menu->created_at)) }}
                                        <br>
                                        {{ date('H:i', strtotime($menu->created_at)) }} @lang('forms.manage.edit.time')
                                    </td>
                                    <td class="text-center">
                                        @if ($menu->created_at != $menu->updated_at)
                                            {{ date('d.m.Y', strtotime($menu->updated_at)) }}
                                            <br>
                                            {{ date('H:i', strtotime($menu->updated_at)) }} @lang('forms.manage.edit.time')
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row pull-right mx-2">
                                                                                    
                                            {{-- Edit --}}
                                            @if (! $menu->order->closed)
                                                <div class="col p-0 text-center">
                                                    <button type="button" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('tables.management.buttons.edit') }}" data-toggle="modal" data-target="#menus.edit.{{ $menu->id }}">
                                                        {!! config('icons.edit') !!}
                                                    </button>
                                                </div>
                                            @endif

                                            {{-- Show --}}
                                            <div class="col p-0 text-center">
                                                <button type="button" class="btn btn-sm btn-link bg-transparent text-dark" title="{{ trans('tables.management.buttons.show') }}" data-toggle="modal" data-target="#menus.show.{{ $menu->id }}">
                                                    {!! config('icons.show') !!}
                                                </button>
                                            </div>
            
                                            {{-- Delete --}}
                                            @if (! $menu->order->closed)
                                                <div class="col p-0 text-center">
                                                    {!! Form::open(['route' => ['menu.destroy', $menu], 'method' => 'DELETE']) !!}
                                                        <button type="submit" class="btn btn-sm btn-link bg-transparent text-danger" title="{{ trans('tables.management.buttons.delete') }}">
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
            
                {{-- {!! $menus->appends(\Request::except('page'))->render() !!} --}}
            </div>

            @include('pages.manage.menus.edit',    [ 'menus' => $menus ])
            @include('pages.manage.menus.show',    [ 'menus' => $menus ])
            
        </div>
    </div>
@endsection

@section('javascript')
    @include('partials._livesearch')
@endsection
