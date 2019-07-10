@foreach ($menus as $menu)
    @if (! $menu->order->closed)
        <div class="modal fade" id="menus.edit.{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $menu->name }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    {{-- Header --}}
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {!! config('icons.fastfood') !!} {{ $menu->order->name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{-- Content --}}
                    <div class="modal-body p-0">
                        <div class="card-body pt-0">
                            {!! Form::model($menu, [ 'route'  => [ 'menu.update', $menu ], 'method' => 'PUT' ]) !!}
                                @csrf
                                <input id="id" name="id" value="{{ $menu->id }}" hidden>
    
                                {{-- Name --}}
                                <div class="form-group col pl-0 pr-3">
                                    {{ Form::label('name', trans('page.manage.edit.form.order_name'), ['class' => 'bmd-label-floating']) }}
                
                                    {{ Form::text('name', null, [
                                        'class'     => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                        'value'     => old('name'),
                                        'minlength' => '5',
                                        'maxlength' => '128',
                                        'required',
                                        'autofocus'
                                    ]) }}
    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
                                {{-- Number --}}
                                <div class="form-group col px-0">
                                    {{ Form::label('number', trans('page.manage.edit.form.number'), ['class' => 'bmd-label-floating']) }}
    
                                    <select name="number" id="number" class="form-control" required>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
    
                                {{-- Price --}}
                                <div class="form-group col pl-0 pr-3">
                                    {{ Form::label('price', trans('page.manage.edit.form.price'), ['class' => 'bmd-label-floating']) }}
                
                                    {{ Form::text('price', null, [
                                        'class'     => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''),
                                        'value'     => old('price'),
                                        'minlenght' => '0',
                                        'max'       => '6',
                                        'required'
                                    ]) }}
    
                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
                                {{-- Comment --}}
                                <div class="form-group col pl-0 pr-3">
                                    {{ Form::label('comment', trans('page.manage.edit.form.comment'), ['class' => 'bmd-label-floating']) }}
                                    {{ Form::textarea('comment', null, [
                                        'class'         => 'form-control',
                                        'rows'          => '5',
                                        'minlenght'     => '0',
                                        'maxlenght'     => '255'
                                    ]) }}
                
                                    @if ($errors->has('comment'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                {{-- Submit --}}
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-block btn-outline-success btn-round">
                                        {!! config('icons.shopping-cart') !!} &ensp; @lang('page.manage.edit.form.submit')
                                    </button>
                                </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
