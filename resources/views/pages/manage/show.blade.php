@foreach ($orders as $order)
    <div class="modal fade" id="orders.show.{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                {{-- Header --}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Content --}}
                <div class="modal-body p-0">

                    {{-- Card Header --}}
                    <div class="card-header card-header-icon">
                        {{-- User Avatar --}}
                        <div class="card-icon p-0 bg-transparent">
                            @if (file_exists(realpath(config('filesystems.avatar.path').$order->user->avatar)))
                                <img 
                                    class="rounded-circle"
                                    src="{{ asset(config('filesystems.avatar.path').$order->user->avatar) }}"
                                    title="{{ $order->user->firstname }} {{ $order->user->surname}} ({{ $order->user->username }})" 
                                    width="64px"
                                    height="64px">
                            @endif
                        </div>

                        {{-- Title --}}
                        <h4 class="card-title row mt-0">
                            <strong class="col-md-8 mt-4">
                                <div class="text-dark">
                                    {{ $order->name }}
                                </div>

                                <small>
                                    <u>
                                        <a href="{{ $order->site_link }}" target="_blank" class="text-muted">
                                            {{ $order->delivery_service }}
                                        </a>
                                    </u>
                                </small>
                            </strong>
                        </h4>
                    </div>

                    {{-- Card Content --}}
                    <div class="card-content mt-2">
                        <div class="container-fluid p-0">
                            @if ($order->menus->isNotEmpty())
                                <table class="table table-sm table-shopping text-center m-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="p-1">@lang('table.orders.head.name')</th>
                                            <th class="p-1">@lang('table.orders.head.menu')</th>
                                            <th class="p-1">@lang('table.orders.head.number')</th>
                                            <th class="p-1">@lang('table.orders.head.comment')</th>
                                            <th class="p-1">@lang('table.orders.head.price')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->menus as $menu)
                                            @if (Auth::user()->id == $menu->user_id)
                                            <tr class="text-primary">
                                            @else
                                            <tr>
                                            @endif
                                                <td class="p-1">{{ $menu->user->firstname }} {{ $menu->user->surname }}</td>
                                                <td class="p-1">{{ $menu->name }}</td>
                                                <td class="p-1">{{ $menu->number }}</td>
                                                <td class="p-1">{{ $menu->comment }}</td>
                                                <td class="p-1">{{ $menu->price }} {{ config('app.currency') }}</td>
                                            </tr>
                                        @endforeach
                                        
                                        <tr>
                                            <td class="p-1"></td>
                                            <td class="p-1"></td>
                                            <td class="p-1"></td>
                                            <td class="p-1"></td>
                                            <th class="p-1 text-center"><strong>{{ $order->sum }} {{ config('app.currency') }}</strong></th>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            @else
                                <div class="text-center">
                                    <h5 class="text-danger"><strong>@lang('table.orders.empty')</strong></h4>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr class="mt-2 mb-0">

                    {{-- Card Footer --}}
                    <div class="card-footer">
                        {{-- Deadline --}}
                        <div class="col-md text-center">
                            @if ($order->timeLeft_min <= 5 || $order->closed)
                            <div class="stats text-danger">

                            @elseif($order->timeLeft_min <= 10)
                            <div class="stats text-warning">

                            @else
                            <div class="stats text-success">
                            @endif

                                {!! config('icons.time') !!} {{ $order->closed ? trans('page.manage.show.noTimeLeft') : $order->timeLeft }}
                            </div>
                        </div>

                        {{-- Participants --}}
                        <div class="col-md text-center">
                            @if (sizeof($order->menus) == $order->max_orders)
                                <div class="stats text-danger">
                            @elseif(sizeof($order->menus) != 0 && (sizeof($order->menus) + 1 == $order->max_orders || sizeof($order->menus) + 2 == $order->max_orders))
                                <div class="stats text-warning">
                            @else
                                <div class="stats text-success">
                            @endif

                                {!! config('icons.checked') !!} {{ sizeof($order->menus) }}/{{ $order->max_orders }} @lang('table.orders.footer.people_count')
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endforeach
