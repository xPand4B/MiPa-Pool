@extends('layouts.main')

@section('title', trans('page.search.title'))

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item active" aria-current="page">@lang('page.search.breadcrumb.index')</li>
        </ol>
    </nav>
@endsection

@section('content')
    Suchergebnisse
@endsection
