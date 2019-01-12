@extends('layouts.main')

@section('title')
    | @lang('page.order.participate.title')
@endsection

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-info">@lang('page.orders.breadcrumb.index')</a></li>
            <li class="breadcrumb-item">@lang('page.orders.breadcrumb.participate')</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $order->name }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    
@endsection