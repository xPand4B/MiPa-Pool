@foreach ($menus as $menu)
    <div class="modal fade" id="menus.show.{{ $menu->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">

                {{-- Header --}}
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $menu->order->name}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Content --}}
                <div class="modal-body">
                    <dl class="row m-0">

                        {{-- Menu --}}
                        <dt class="col-sm-2 text-warning">
                            {!! config('icons.shopping-cart') !!}
                        </dt>
                        <dd class="col-sm-10 text-muted">
                            <a href="{{ $menu->order->site_link }}" target="_blank">{{ $menu->order->delivery_service }}</a>
                        </dd>
    
                        {{-- Menu --}}
                        <dt class="col-sm-2 text-warning">
                            {!! config('icons.fastfood-sm') !!}
                        </dt>
                        <dd class="col-sm-10">
                            {{ $menu->number }}x {{ $menu->name }}
                        </dd>
    
                        {{-- Price --}}
                        <dt class="col-sm-2 text-success">
                            {!! config('icons.money-sm') !!}
                        </dt>
                        <dd class="col-sm-10">
                            {{ $menu->price }} {{ config('app.currency') }}
                        </dd>
    
                        {{-- Created at --}}
                        <dt class="col-sm-2">
                            {!! config('icons.calender-sm') !!}
                        </dt>
                        <dd class="col-sm-10">
                            {{ date('d.m.Y - H:i', strtotime($menu->created_at)) }} @lang('page.manage.edit.form.time')
                        </dd>

                        {{-- Updated at --}}
                        @if ($menu->created_at != $menu->updated_at)
                            <dt class="col-sm-2">
                                {!! config('icons.refresh') !!}
                            </dt>
                            <dd class="col-sm-10">
                                {{ date('d.m.Y - H:i', strtotime($menu->updated_at)) }} @lang('page.manage.edit.form.time')
                            </dd>
                        @endif
                    </dl>
                </div>

                {{-- Content --}}
                @if (isset($menu->comment))
                    <hr class="m-0">
            
                    <div class="m-2 text-center text-muted">
                        {{ $menu->comment }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endforeach
