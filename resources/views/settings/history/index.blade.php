@extends('settings.base')

@section('settings_content')
    <h2 class="ui dividing header">
        @lang('trans/settings.history.title')
    </h2>
    <div class="ui styled fluid accordion">
        @foreach($histories as $history)
            <div class="title">
                <i class="dropdown icon"></i>@lang('trans/settings.history.titles.' . $history->action)
                <span class="ui right floated">{{ $history->performed_at }}</span>
            </div>
            <div class="content">
                <div class="transition hidden">
                    @if((int)$history->action === \App\Model\Web\Log::ACTION_TYPE_BUY_SHOP)
                        @include('settings.history.include.buy_shop', ['cart' => unserialize($history->value)])
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

<?php /** @var \App\Model\Web\Log $history */ ?>
