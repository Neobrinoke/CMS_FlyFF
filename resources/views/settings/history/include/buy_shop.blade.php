<table class="ui single line compact selectable table">
    <thead>
        <tr>
            <th>@lang('settings.history.buy_shop.cart.image')</th>
            <th>@lang('settings.history.buy_shop.cart.name')</th>
            <th>@lang('settings.history.buy_shop.cart.quantity')</th>
            <th class="right aligned">@lang('settings.history.buy_shop.cart.unit_price')</th>
            <th class="right aligned">@lang('settings.history.buy_shop.cart.ttl_price')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cart->items as $item)
            <tr>
                <td><img src="{{ $item->image_thumbnail }}" alt="" width="32" height="32"></td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->quantity }}</td>
                @if($item->sale_type === \App\Model\Web\Shop::SALE_CS_TYPE)
                    <td class="right aligned">{{ $item->price }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('shop.sale_types.1')"></td>
                    <td class="right aligned">{{ $item->total_price }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('shop.sale_types.1')"></td>
                @else
                    <td class="right aligned">{{ $item->price }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('shop.sale_types.2')"></td>
                    <td class="right aligned">{{ $item->total_price }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('shop.sale_types.2')"></td>
                @endif
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th class="right aligned">{{ $cart->getTotalTtlCsPrice() }} <img src="{{ asset('images/sale_cs_image.png') }}" title="@lang('shop.sale_types.1')"></th>
            <th class="right aligned">{{ $cart->getTotalTtlVotePrice() }} <img src="{{ asset('images/sale_vote_image.png') }}" title="@lang('shop.sale_types.2')"></th>
        </tr>
    </tfoot>
</table>