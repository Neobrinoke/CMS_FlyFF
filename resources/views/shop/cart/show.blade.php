@extends('base')

@section('title', trans('trans/title.cart'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="shopping basket icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <h3 class="ui dividing header">@lang('trans/shop.cart.cart_summary')</h3>
            <table class="ui single line compact selectable table">
                <thead>
                    <tr>
                        <th></th>
                        <th>@lang('trans/shop.cart.image')</th>
                        <th>@lang('trans/shop.cart.name')</th>
                        <th>@lang('trans/shop.cart.quantity')</th>
                        <th class="right aligned">@lang('trans/shop.cart.unit_price') <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></th>
                        <th class="right aligned">@lang('trans/shop.cart.unit_price') <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></th>
                        <th class="right aligned">@lang('trans/shop.cart.ttl_price') <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></th>
                        <th class="right aligned">@lang('trans/shop.cart.ttl_price') <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->items as $item)
                        <tr>
                            <td class="collapsing">
                                <form action="{{ route('shop.cart.destroy', [$item]) }}" method="POST">
                                    @csrf
                                    <button class="ui red basic compact icon button" type="submit"><i class="remove icon"></i></button>
                                </form>
                            </td>
                            <td><img src="{{ $item->image_thumbnail }}" alt="" width="32" height="32"></td>
                            <td><a href="{{ route('shop.item', [$item->shop, $item, $item->slug]) }}">{{ $item->title }}</a></td>
                            <td>
                                <form class="ui form" action="{{ route('shop.cart.update', [$item]) }}" method="POST">
                                    @csrf
                                    <button class="ui mini basic vertical icon button" type="submit" name="direction" value="down"><i class="minus icon"></i></button>
                                    <div class="ui mini input">
                                        <input style="max-width: 100px; max-height: 28.28px; margin-right: 3px;" class="mini center aligned" type="text" value="{{ $item->quantity }}" readonly>
                                    </div>
                                    <button class="ui mini basic vertical icon button" type="submit" name="direction" value="up"><i class="plus icon"></i></button>
                                </form>
                            </td>
                            @if($item->sale_type === \App\Model\Web\Shop::SALE_CS_TYPE)
                                <td class="right aligned">{{ $item->price }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></td>
                                <td class="right aligned">0 <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></td>
                                <td class="right aligned">{{ $item->total_price }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></td>
                                <td class="right aligned">0 <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></td>
                            @else
                                <td class="right aligned">0 <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></td>
                                <td class="right aligned">{{ $item->price }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></td>
                                <td class="right aligned">0 <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></td>
                                <td class="right aligned">{{ $item->total_price }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="right aligned">{{ $cart->getTotalUnitCsPrice() }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></th>
                        <th class="right aligned">{{ $cart->getTotalUnitVotePrice() }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></th>
                        <th class="right aligned">{{ $cart->getTotalTtlCsPrice() }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></th>
                        <th class="right aligned">{{ $cart->getTotalTtlVotePrice() }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></th>
                    </tr>
                </tfoot>
            </table>
            @if($cart->isNotEmpty())
                <h3 class="ui dividing header">@lang('trans/shop.cart.buy_summary')</h3>
                @if($loggedUser->characters->isNotEmpty())
                    <section class="ui stackable grid">
                        <div class="four wide column">
                            <p>@lang('trans/shop.cart.you_have')</p>
                            <p>{{ $loggedUser->cash_point }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></p>
                            <p>{{ $loggedUser->vote_point }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></p>
                        </div>
                        <div class="four wide column">
                            <p>@lang('trans/shop.cart.you_will_have')</p>
                            <p>{{ $loggedUser->cash_point - $cart->getTotalTtlCsPrice() }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('trans/shop.sale_types.1')"></p>
                            <p>{{ $loggedUser->vote_point - $cart->getTotalTtlVotePrice() }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('trans/shop.sale_types.2')"></p>
                        </div>
                        <div class="height wide column">
                            <form class="ui form" action="{{ route('shop.cart.buy') }}" method="POST">
                                @csrf
                                <div class="field">
                                    <select class="ui dropdown" name="character">
                                        <option value="">@lang('trans/shop.cart.select_char')</option>
                                        @foreach($loggedUser->characters as $character)
                                            <option value="{{ $character->m_idPlayer }}">{{ $character->account }} - {{ $character->m_szName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="ui fluid primary button">@lang('trans/shop.cart.buy')</button>
                            </form>
                        </div>
                    </section>
                @else
                    <div class="ui error message">
                        <p>@lang('trans/shop.cart.no_chars')</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

<?php /** @var \App\Helper\Cart $cart */ ?>
<?php /** @var \App\Model\Web\ShopItem $item */ ?>
<?php /** @var \App\Model\Web\User $loggedUser */ ?>
<?php /** @var \App\Model\Character\Character $character */ ?>
