@extends('layouts.main')

@section('title', trans('page.manage.title'))

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item"><a href="{{ route('manage.index') }}" class="text-info">@lang('page.manage.breadcrumb.index')</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $order->name }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    
@endsection
