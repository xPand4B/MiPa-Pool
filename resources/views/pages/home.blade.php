@extends('layouts.main')

@section('headline', 'Aktuelle Bestellungen')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="card card-chart">
            {{-- Card Header --}}
            <div class="card-header card-header-secondary card-header-icon">
                <div class="card-icon p-0 bg-transparent">
                    {{-- <i class="material-icons">person</i> --}}
                    <img src="{{ asset('img/profile/Fairy Tail.jpg') }}" title="Eric Heinzl" width="64px" height="64px" style="border-radius: 32px">
                </div>
                <h4 class="card-title">
                    <strong>
                        Bestellung bei Lieferheld
                    </strong>
                </h4>
            </div>  
            {{-- Card Category --}}
            <div class="card-category text-muted">
            </div>

            <hr>
            
            {{-- Card Content --}}
            <div class="card-content">
                <div class="container responsive">
                    <table class="table table-responsive-sm table-striped table-shopping text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="p-1">#</th>
                                <th class="p-1">Name</th>
                                <th class="p-1">Menü</th>
                                <th class="p-1">Anzahl</th>
                                <th class="p-1">Kommentar</th>
                                <th class="p-1">Preis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-1">5</td>
                                <td class="p-1">Eric Heinzl</td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1">4</td>
                                <td class="p-1">Eric Heinzl</td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1">3</td>
                                <td class="p-1">Eric Heinzl</td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1">2</td>
                                <td class="p-1">Eric Heinzl</td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1">1</td>
                                <td class="p-1">Eric Heinzl</td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                            </tr>
                            <tr>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <th class="p-1">38,00€</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <hr class="mt-0">
                <div class="container">
                    <a href="#" class="btn btn-block" >Mitbestellen</a>
                </div>
            <hr class="mb-0">

            {{-- Card Footer --}}
            <div class="card-footer">
                <div class="col-sm">
                    <div class="stats text-danger">
                        <i class="material-icons">access_time</i> 4 min. verbleibend
                    </div>
                </div>
                <div class="col-sm text-center">
                    <div class="stats">
                        <i class="material-icons pl-1">person</i> Eric Heinzl
                    </div>
                </div>
                <div class="col-sm text-right">
                    <div class="stats text-success">
                        <i class="material-icons">done</i> 5/10 Personen
                    </div>
                </div>
            </div>
        </div>{{-- end Card --}}
    </div>

@endsection