@extends('layouts.main')

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            {{-- <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name}}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->firstname}} {{ Auth::user()->surname}}</li> --}}
        </ol>
    </nav>
@endsection

@section('content')
    
    <div class="col-md-10 offset-md-1">
        <div class="card card-chart">
            {{-- Card Header --}}
            <div class="card-header card-header-transparent card-header-icon">
                <div class="card-icon p-0 bg-transparent">
                    <img src="{{ asset('img/profile/Fairy Tail.jpg') }}" title="" width="64px" height="64px" style="border-radius: 32px">
                </div>
            </div>

            <hr>

            {{-- Card Content --}}
            <div class="card-content">
                <div class="container responsive">
                    <div class="row">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection