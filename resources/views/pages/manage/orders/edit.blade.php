@foreach ($orders as $order)
    @if (! $order->closed)
        <div class="modal fade" id="orders.edit.{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $order->name }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    {{-- Header --}}
                    <div class="modal-header">
                        {{-- <h5 class="modal-title">Modal title</h5> --}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{-- Content --}}
                    <div class="modal-body p-0">
                        {{-- Card Header --}}
                        <div class="card-header card-header-transparent card-header-icon">
                            <div class="card-icon p-0 m-0 bg-transparent row text-center" style="float: none">
                                
                                {{-- Lieferheld --}}
                                <div class="col">
                                    <img src="{{ asset('img/lieferheld_400x400.png') }}" title="" width="82px" height="82px" style="border-radius: 41px" data-toggle="modal" data-target="#mysticModal01">
                                </div>

                                {{-- Pizza.de --}}
                                <div class="col">
                                    <img src="{{ asset('img/pizza.de_1200x1200.png') }}" title="" width="82px" height="82px" style="border-radius: 41px" data-toggle="modal" data-target="#mysticModal01">
                                </div>

                                {{-- Lieferando --}}
                                <div class="col">
                                    <img src="{{ asset('img/lieferando_512x512.png') }}" title="" width="82px" height="82px" style="border-radius: 41px" data-toggle="modal" data-target="#mysticModal01">
                                </div>
                            </div>
                        </div>
                        
                        {{-- Card Content --}}
                        <div class="card-body">
                            {!! Form::model($order, [ 'route'  => [ 'orders.update', $order ], 'method' => 'PUT' ]) !!}
                                @csrf
                                <input id="id" name="id" value="{{ $order->id }}" hidden>

                                {{-- Order Name --}}
                                <div class="form-group is-focused">
                                    {{ Form::label('name', trans('forms.manage.edit.order_name'), ['class' => 'bmd-label-floating']) }}
                
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $order->name }}" required autofocus>
                
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- Deadline --}}
                                <div class="form-group col pl-0 pr-3">
                                    {{ Form::label('deadline', trans('forms.manage.edit.deadline'), ['class' => 'bmd-label-floating']) }}

                                    <select name="deadline" id="deadline" class="form-control text-gray" disabled>
                                        <option value="{{ $order->deadline }}" selected>{{ date('d.m.Y - H:i', strtotime($order->deadline)) }} @lang('forms.manage.edit.time')</option>
                                    </select>
                                </div>
                
                                {{-- Max Orders | Minimum order value --}}
                                <div class="form-row" style="padding-left: 5px">

                                    {{-- Max Orders --}}
                                    <div class="form-group col px-0 pr-3">
                                        {{ Form::label('max_orders', trans('forms.manage.edit.max_orders'), ['class' => 'bmd-label-floating']) }}

                                        <select name="max_orders" id="max_orders" class="form-control" required>
                                            @for ($i = $order->menus->count(); $i <= 20; $i++)
                                                @if ($i == $order->max_orders)
                                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                                @else
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>

                                    {{-- Minimun order value --}}
                                    <div class="form-group col">
                                        {{ Form::label('minimum_value', trans('forms.manage.edit.minimum_order_value'), ['class' => 'bmd-label-floating']) }}

                                        <select name="minimum_value" id="minimum_value" class="form-control" required>
                                            @for ($i = 0; $i <= 20; $i++)
                                                @if ($i == $order->minimum_value)
                                                    <option value="{{ $i }}" selected>{{ $i }} {{ config('app.currency') }}</option>
                                                @else
                                                    <option value="{{ $i }}">{{ $i }} {{ config('app.currency') }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                
                                {{-- Delivery Service --}}
                                <div class="form-group col pl-0 pr-3">
                                    {{ Form::label('delivery_service', trans('forms.manage.edit.delivery_service'), ['class' => 'bmd-label-floating']) }}
            
                                    <input id="delivery_service" type="text" class="form-control{{ $errors->has('delivery_service') ? ' is-invalid' : '' }}" name="delivery_service" value="{{ $order->delivery_service }}" required>
            
                                    @if ($errors->has('delivery_service'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('delivery_service') }}</strong>
                                        </span>
                                    @endif
                                </div>
                
                                {{-- Site Link --}}
                                <div class="form-group col px-0">
                                    {{ Form::label('site_link', trans('forms.manage.edit.site_link'), ['class' => 'bmd-label-floating']) }}
            
                                    <input id="site_link" type="text" class="form-control{{ $errors->has('site_link') ? ' is-invalid' : '' }}" name="site_link" value="{{ $order->site_link }}" required>
            
                                    @if ($errors->has('site_link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('site_link') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- Submit --}}
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-block btn-success btn-round">
                                        {!! config('icons.shopping-cart') !!} &ensp; @lang('forms.manage.edit.submit')
                                    </button>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endforeach
