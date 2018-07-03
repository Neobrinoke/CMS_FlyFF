@extends('base')

@section('title', __('trans/title.shop'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="shopping cart icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <h2 class="ui dividing center aligned header">@lang('trans/shop.choose_shop')</h2>
            <div class="ui link three centered stackable cards">
                @foreach($shops as $shop)
                    <div class="card">
                        @if($shop->image_thumbnail)
                            <a class="image" href="{{ route('shop.show', [$shop, $shop->slug]) }}"><img src="{{ $shop->image_thumbnail }}"></a>
                        @endif
                        <div class="content">
                            <span class="header center aligned">{{ $shop->label }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Web\Shop $shop */ ?>