@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">

                <div class="card-body pb-2">

                    {{-- Header --}}
                    <div class="h2 pb-2">
                        Passwort zurücksetzten
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="form-group is-focused">
                            <label for="email" class="bmd-label-floating">
                                E-Mail Adresse
                            </label>

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{-- Submit --}}
                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-block btn-success">
                                <i class="fa fa-paper-plane"></i> &ensp; E-Mail beantragen
                            </button>
                        </div>

                        <hr class="mt-1 mb-4">

                        <div class="text-center py-0">
                            Neu hier?
                            <a href="{{ route('register') }}" class="btn btn-link py-0 pl-1 pr-0 text-info">
                                Erstelle dir einen Account.
                            </a>
                        </div>
                        
                        <div class="py-1"></div>

                        {{-- Already have an account --}}
                        <div class="text-center py-0">
                            Du hast bereits einen Account?
                            <a href="{{ route('login') }}" class="btn btn-link py-0 pl-1 pr-0 text-info">
                                Hier anmelden.
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
