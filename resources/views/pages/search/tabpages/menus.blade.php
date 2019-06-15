<div class="row justify-content-center">
    @foreach ($menus as $menu)
    <div class="col-md-4">
        @if (Auth::user()->id == $menu->user_id)
        <div class="card card-chart border border-primary mb-5">    
        @else
        <div class="card card-chart mb-2">
        @endif
            {{-- Header --}}
            <div class="card-header">
                <dl class="row m-0">

                    {{-- Menu --}}
                    <dt class="col-sm-2 text-warning">
                        <i class="fa fa-sm fa-shopping-cart" aria-hidden="true"></i>
                    </dt>
                    <dd class="col-sm-10 text-muted">
                        <a href="{{ $menu->order->site_link }}" target="_blank">{{ $menu->order->name }}</a>
                    </dd>

                    {{-- User --}}
                    <dt class="col-sm-2 text-primary">
                        <i class="fa fa-sm fa-user" aria-hidden="true"></i>
                    </dt>
                    @if (Auth::user()->id == $menu->user_id)
                    <dd class="col-sm-10 text-primary">
                    @else
                    <dd class="col-sm-10">
                    @endif
                        {{ $menu->user->Fullname }} ({{ $menu->user->username }})
                    </dd>

                    {{-- Menu --}}
                    <dt class="col-sm-2 text-warning">
                        <i class="fa fa-sm fa-cutlery" aria-hidden="true"></i>
                    </dt>
                    <dd class="col-sm-10">
                        {{ $menu->number }}x {{ $menu->name }}
                    </dd>

                    {{-- Price --}}
                    <dt class="col-sm-2 text-success">
                        <i class="fa fa-sm fa-money" aria-hidden="true"></i>
                    </dt>
                    <dd class="col-sm-10">
                        {{ $menu->price }} ,-€
                    </dd>

                    {{-- Created at --}}
                    <dt class="col-sm-2">
                        <i class="fa fa-sm fa-calendar" aria-hidden="true"></i>
                    </dt>
                    <dd class="col-sm-10">
                        {{ $menu->created_at }}
                    </dd>
                </dl>
            </div>

            {{-- Content --}}
            @if (isset($menu->comment))
            <hr class="m-0">
    
            <div class="card-body text-center p-2">
                <p class="card-description m-0">
                    {{ $menu->comment }}
                </p>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
