@extends('layout')

@section('title', trans('title.email_verify'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            @if(session('resent'))
                <div class="alert alert-success" role="alert">
                    @lang('email_verify.link_resent')
                </div>
            @endif

            @lang('email_verify.check_email')
            <br>
            @lang('email_verify.do_not_receive') <a href="{{ route('verification.resend') }}">@lang('email_verify.send_new_link')</a>
        </div>
    </div>
@endsection
