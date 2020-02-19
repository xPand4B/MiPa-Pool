@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else

@if ($level === 'error')
# @lang('mail.greeting.error')
@else
# @lang('mail.greeting.normal') {{ isset($user->username) ? $user->username : ''}}!
@endif

@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

{{-- Action Button --}}
@if (! empty($actionText) && !empty($actionUrl))

@php
    switch ($level) {
        case 'success':
            $color = $level;
            break;

        case 'error':
            $color = $level;
            break;

        default:
            $color = 'primary';
            break;
    }
@endphp

@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent

@endif


{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('mail.regards', ['name' => config('app.name')])
@endif

{{-- Subcopy --}}
@if (! empty($actionText) && !empty($actionUrl))

@component('mail::subcopy')
@lang('mail.subcopy', ['actionText' => $actionText, 'actionURL' => $actionUrl])
@endcomponent

@endif

@endcomponent
