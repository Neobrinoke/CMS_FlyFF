@extends('settings.base')

@section('settings_content')
    <h2 class="ui dividing header">
        @lang('settings.history.title')
    </h2>
    <div class="ui styled fluid accordion">
        @foreach($histories as $history)
            <div class="title">
                <i class="dropdown icon"></i>@lang('settings.history.titles.' . $history->action)
                <span class="ui right floated"><time datetime="{{ $history->performed_at }}">{{ $history->performed_at }}</time></span>
            </div>
            <div class="content">
                <div class="transition hidden">
                    @if($history->action === \App\Model\Web\UserLog::ACTION_TYPE_BUY_SHOP)
                        @include('settings.history.include.buy_shop', ['cart' => $history->value])
                    @elseif($history->action === \App\Model\Web\UserLog::ACTION_TYPE_LOGIN)
                        <p>@lang('settings.history.login.message', ['ip' => $history->ip_address])</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

<?php /** @var \App\Model\Web\UserLog $history */ ?>
