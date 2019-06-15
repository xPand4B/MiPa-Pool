<div class="row mt-4 justify-content-center">
    @foreach ($orders as $order)
        <div class="col-md-4">
            @if (Auth::user()->id == $order->user_id)
            <div class="card card-chart border border-primary mb-5">    
            @else
            <div class="card card-chart mb-3">
            @endif

                {{-- Card Header --}}
                <div class="card-header card-header-icon">
                    {{-- User Icon --}}
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
                    <h4 class="card-title mt-0">
                        <div class="row">
                            <strong class="col mt-4">
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
                        </div>

                        <div class="colmt-2">
                            @if (sizeof($order->menus) == $order->max_orders)
                                <a href="#" class="btn btn-sm btn-block btn-round disabled" disabled>

                            @elseif(sizeof($order->menus) != 0 && (sizeof($order->menus) + 1 == $order->max_orders || sizeof($order->menus) + 2 == $order->max_orders))
                                <a href="{{ route('participate.create', ['order' => $order]) }}" class="btn btn-sm btn-block btn-warning btn-round">

                            @else
                                <a href="{{ route('participate.create', ['order' => $order]) }}" class="btn btn-sm btn-block btn-success btn-round">
                            @endif

                                <i class="fa fa-cart-plus"></i>
                                @lang('table.orders.participate')
                            </a>
                        </div>
                    </h4>
                </div>  
                
                <hr class="mt-2 mb-0">

                {{-- Card Footer --}}
                <div class="card-footer">
                    <ul class="list-group list-group-flush">
                        {{-- Deadline --}}
                        <li class="list-group-item p-0">
                            @if ($order->timeLeft_min <= 5)
                                <div class="stats text-danger">

                            @elseif($order->timeLeft_min <= 10)
                                <div class="stats text-warning">

                            @else
                                <div class="stats text-success">
                            @endif

                                <i class="material-icons">access_time</i> {{ $order->deadline }}
                            </div>
                        </li>

                        {{-- Creator --}}
                        <li class="list-group-item px-0 py-2">
                            @if (Auth::user()->id == $order->user_id)
                            <div class="stats text-primary">
                            @else
                            <div class="stats">
                            @endif
                                <i class="material-icons">person</i> {{ $order->user->firstname }} {{ $order->user->surname}} ({{ $order->user->username }})
                            </div>
                        </li>
                        
                        {{-- Participants --}}
                        <li class="list-group-item p-0">
                            @if (sizeof($order->menus) == $order->max_orders)
                                <div class="stats text-danger">
                            @elseif(sizeof($order->menus) != 0 && (sizeof($order->menus) + 1 == $order->max_orders || sizeof($order->menus) + 2 == $order->max_orders))
                                <div class="stats text-warning">
                            @else
                                <div class="stats text-success">
                            @endif

                                <i class="material-icons">done</i> {{ sizeof($order->menus) }}/{{ $order->max_orders }} @lang('table.orders.footer.people_count')
                            </div>
                        </li>
                    </ul>                   
                </div>
            </div>
        </div>
    @endforeach
</div>
