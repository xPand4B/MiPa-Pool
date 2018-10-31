@extends('layouts.main')

@section('headline', 'Profil')

@section('title', '| Profil')

@section('content')
    
    <div class="col-md-10 offset-md-1">
        <div class="card card-chart">
            {{-- Card Header --}}
            <div class="card-header card-header-secondary card-header-icon">
                <div class="card-icon p-0 bg-transparent">
                    <img src="{{ asset('img/profile/Fairy Tail.jpg') }}" title="Eric Heinzl" width="64px" height="64px" style="border-radius: 32px">
                </div>
            </div>

            {{-- Card Category --}}
            {{-- <div class="card-category text-muted"></div> --}}
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