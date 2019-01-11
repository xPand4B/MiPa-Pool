@extends('layouts.main')

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            {{-- <li class="breadcrumb-item"><a href="{{ url('dashboard/posts') }}" class="text-danger">Posts</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page">@lang('page.orders.breadcrumb.index')</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="card card-chart">
            {{-- Card Header --}}
            <div class="card-header card-header-icon">
                {{-- User Icon --}}
                <div class="card-icon p-0 bg-transparent">
                    <img src="{{ asset('img/profile/Fairy Tail.jpg') }}" title="Eric Heinzl" width="64px" height="64px" style="border-radius: 32px">
                </div>

                {{-- Title --}}
                <h4 class="card-title row mt-0">
                    <strong class="col-md-8 mt-4">
                        Bestellung bei Lieferheld
                    </strong>

                    <div class="col-md-4 mt-2">
                        <a href="{{ route('order.participate') }}" class="btn btn-block btn-info btn-round">
                            <i class="fa fa-cart-plus"></i>
                            @lang('table.orders.participate')
                        </a>
                    </div>
                </h4>
            </div>  

            <hr class="mt-2">
            
            {{-- Card Content --}}
            <div class="card-content">
                <div class="container responsive">
                    <table class="table table-responsive-sm table-hover table-striped table-shopping text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="p-1">@lang('table.orders.head.count')</th>
                                <th class="p-1">@lang('table.orders.head.name')</th>
                                <th class="p-1">@lang('table.orders.head.menu')</th>
                                <th class="p-1">@lang('table.orders.head.number')</th>
                                <th class="p-1">@lang('table.orders.head.comment')</th>
                                <th class="p-1">@lang('table.orders.head.price')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-1">10</td>
                                <td class="p-1">Eric Heinzl</td>
                                <td class="p-1">
                                    Bacon Burger
                                    <br>
                                    <hr class="my-0 py-0">
                                    Pizza
                                </td>
                                <td class="p-1">
                                    1
                                    <br>
                                    <hr class="my-0 py-0">
                                    1
                                </td>
                                <td class="p-1"></td>
                                <td class="p-1">
                                    9,20 €
                                    <br>
                                    <hr class="my-0 py-0">
                                    6,00 €
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr> --}}
                            <tr>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1">9</td>
                                <td class="p-1">Henning</td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1">8</td>
                                <td class="p-1">Vural</td>
                                <td class="p-1">Salat</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1">7</td>
                                <td class="p-1">Marvin</td>
                                <td class="p-1">Kebab Pizza</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1">6</td>
                                <td class="p-1">Stuart</td>
                                <td class="p-1">Bacon Burger</td>
                                <td class="p-1">1</td>
                                <td class="p-1"></td>
                                <td class="p-1">7,80 €</td>
                            </tr>
                            <tr>
                                <td class="p-1"></td>
                                <td class="p-1"></td>
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
                                <th class="p-1">38,00€</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- <hr class="mt-0">
                <div class="container">
                    <a href="#" class="btn btn-block" >Mitbestellen</a>
                </div> --}}
            <hr class="mb-0">

            {{-- Card Footer --}}
            <div class="card-footer">
                <div class="col-md">
                    <div class="stats text-danger">
                        <i class="material-icons">access_time</i> 4 @lang('table.orders.footer.time_left')
                    </div>
                </div>
                <div class="col-md text-center">
                    <div class="stats">
                        <i class="material-icons pl-1">person</i> Eric Heinzl
                    </div>
                </div>
                <div class="col-md text-right">
                    <div class="stats text-success">
                        <i class="material-icons">done</i> 5/10 @lang('table.orders.footer.people_count')
                    </div>
                </div>
            </div>
        </div>{{-- end Card --}}
    </div>

@endsection