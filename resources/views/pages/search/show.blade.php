@extends('layouts.main')

@section('title', trans('page.search.title') . ': ' . $search)

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item">@lang('page.search.breadcrumb.index')</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $search }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            
            {{-- Header --}}
            <div class="card-header card-header-tabs card-header-primary">
                {{-- Tab Menu --}}
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            {{-- Tab Orders --}}
                            <li class="nav-item">
                                <a class="nav-link active show" href="#orders" data-toggle="tab">
                                    <i class="material-icons">shopping_cart</i>
                                    <span class="badge badge-pill badge-light">{{ sizeof($orders) }}</span>
                                    @lang('page.search.tabpages.orders.title')
                                </a>
                            </li>
                            
                            {{-- Tab Menus --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#menus" data-toggle="tab">
                                    <i class="material-icons">fastfood</i>
                                    <span class="badge badge-pill badge-light">{{ sizeof($menus) }}</span>
                                    @lang('page.search.tabpages.menus.title')
                                </a>
                            </li>

                            {{-- Tab Users --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#users" data-toggle="tab">
                                    <i class="material-icons">person</i>
                                    <span class="badge badge-pill badge-light">{{ sizeof($users) }}</span>
                                    @lang('page.search.tabpages.users.title')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body py-0">
                {{-- Tab Content --}}
                <div class="tab-content">

                    {{-- Orders --}}
                    <div class="tab-pane active" id="orders">
                    @if (sizeof($orders) != 0)
                        @include('pages.search.tabpages.orders', ['orders' => $orders])
                    @else
                        @include('pages.search.tabpages.empty')
                    @endif
                    </div>
                    
                    {{-- Menus --}}
                    <div class="tab-pane" id="menus">
                    @if (sizeof($menus) != 0)
                        @include('pages.search.tabpages.menus', ['menus' => $menus])
                    @else
                        @include('pages.search.tabpages.empty')
                    @endif
                    </div>

                    {{-- Users --}}
                    <div class="tab-pane" id="users">
                    @if (sizeof($users) != 0)
                        @include('pages.search.tabpages.users', ['users' => $users])
                    @else
                        @include('pages.search.tabpages.empty')
                    @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
