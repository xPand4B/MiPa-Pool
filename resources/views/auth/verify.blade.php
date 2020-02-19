@extends('layouts.login')

@section('headline', trans('login.verify.header'))

@section('content')
    @lang('login.verify.instruction')
    @lang('login.verify.resend_text_start'), <a href="{{ route('verification.resend') }}">@lang('login.verify.resend_text_link')</a> @lang('login.verify.resend_text_end')
@endsection
