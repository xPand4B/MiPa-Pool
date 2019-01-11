@extends('layouts.main')

@section('title')
    | @lang('page.imprint.title')
@endsection

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item active" aria-current="page">@lang('page.imprint.breadcrumb.index')</li>
        </ol>
    </nav>
@endsection
    
@section('content')
    
    <div class="col-md">
        <div class="card">
            {{-- Card Header --}}
            <div class="card-header card-header-warning">
                <h4 class="card-title">@lang('page.imprint.headline')</h4>
                <p class="card-category"></p>
            </div>

            {{-- Card Body --}}
            <div class="card-body">

                {{-- Your content here --}}

            </div>
        </div>
    </div>
@endsection    