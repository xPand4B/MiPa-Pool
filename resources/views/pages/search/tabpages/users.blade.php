<div class="row mt-4 justify-content-center">
    @foreach ($users as $user)
    <div class="col-md-4">
        <div class="card p-3">
            {{-- Header --}}
            <div class="card-header card-header-icon justify-content-center">
                <div class="card-icon p-0 bg-transparent">
                    @if (file_exists(realpath(config('filesystems.avatar.path').$user->avatar)))
                    <img
                        class="rounded-circle" 
                        src="{{ asset(config('filesystems.avatar.path').$user->avatar) }}" 
                        title="{{ $user->firstname }} {{ $user->surname}} ({{ $user->username }})" 
                        width="82px" 
                        height="82px">
                    @endif
                </div>

                {{-- Title --}}
                <h4 class="card-title row mt-0">
                    <h5 class="m-0 text-gray">{{ $user->username}}</h5>
                    <h3 class="m-0 card-title">{{ $user->firstname}} {{ $user->surname }}</h3>
                </h4>
            </div>

            @if (isset($user->about_me))
            <hr class="mb-0">
            
            <div class="card-body text-center pb-0">
                <p class="card-description m-0">
                    {{ $user->about_me }}
                </p>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
