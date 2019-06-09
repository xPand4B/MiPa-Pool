@extends('layouts.login')

@section('headline', trans('login.verify.header'))

@section('content')
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            @lang('login.verify.new_link_send')
        </div>
    @endif

    @lang('login.verify.instruction')
    @lang('login.verify.resend_text_start'), <a href="{{ route('verification.resend') }}">@lang('login.verify.resend_text_link')</a> @lang('login.verify.resend_text_end')
@endsection
