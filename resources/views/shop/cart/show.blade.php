@extends('base')

@section('title', __('site.title.cart'))

@section('content')
	<div class="box">
		<div class="ui primary attached message">
			<h1 class="header">@yield('title')</h1>
		</div>
		<div class="ui attached fluid clearing segment">
			<table class="ui single line compact selectable table">
				<thead>
					<tr>
						<th></th>
						<th>@lang('site.shop.cart.image')</th>
						<th>@lang('site.shop.cart.name')</th>
						<th>@lang('site.shop.cart.quantity')</th>
						<th class="right aligned">@lang('site.shop.cart.unit_price') <img src="{{ asset('img/sale_cs_image.png') }}" title="@lang('site.shop.sale_types.1')"></th>
						<th class="right aligned">@lang('site.shop.cart.unit_price') <img src="{{ asset('img/sale_vote_image.png') }}" title="@lang('site.shop.sale_types.2')"></th>
						<th class="right aligned">@lang('site.shop.cart.ttl_price') <img src="{{ asset('img/sale_cs_image.png') }}" title="@lang('site.shop.sale_types.1')"></th>
						<th class="right aligned">@lang('site.shop.cart.ttl_price') <img src="{{ asset('img/sale_vote_image.png') }}" title="@lang('site.shop.sale_types.2')"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($cart->items as $item)
						<tr>
							<td class="collapsing">
								<form action="{{ route('shop.cart.destroy', [$item]) }}" method="POST">
									@csrf
									<button class="ui red basic icon button" type="submit"><i class="remove icon"></i></button>
								</form>
							</td>
							<td><img src="{{ $item->image_thumbnail }}" alt="" width="32" height="32"></td>
							<td><a href="{{ route('shop.item', [$item->shop, $item, $item->slug]) }}">{{ $item->title }}</a></td>
							<td>
								<form class="ui form" action="{{ route('shop.cart.update', [$item]) }}" method="POST">
									@csrf
									<button class="ui mini basic vertical icon button" type="submit" name="direction" value="down"><i class="minus icon"></i></button>
									<div class="ui mini input">
										<input style="max-width: 50px; max-height: 28.28px; margin-right: 3px;" class="mini center aligned" type="text" value="{{ $item->quantity }}" readonly>
									</div>
									<button class="ui mini basic vertical icon button" type="submit" name="direction" value="up"><i class="plus icon"></i></button>
								</form>
							</td>
							@if(intval($item->sale_type) === \App\Model\Web\ShopItem::SALE_CS_TYPE)
								<td class="right aligned">{{ $item->price }} <img src="{{ asset('img/sale_cs_image.png') }}" title="@lang('site.shop.sale_types.1')"></td>
								<td class="right aligned">0 <img src="{{ asset('img/sale_vote_image.png') }}" title="@lang('site.shop.sale_types.2')"></td>
								<td class="right aligned">{{ $item->total_price }} <img src="{{ asset('img/sale_cs_image.png') }}" title="@lang('site.shop.sale_types.1')"></td>
								<td class="right aligned">0 <img src="{{ asset('img/sale_vote_image.png') }}" title="@lang('site.shop.sale_types.2')"></td>
							@else
								<td class="right aligned">0 <img src="{{ asset('img/sale_cs_image.png') }}" title="@lang('site.shop.sale_types.1')"></td>
								<td class="right aligned">{{ $item->price }} <img src="{{ asset('img/sale_vote_image.png') }}" title="@lang('site.shop.sale_types.2')"></td>
								<td class="right aligned">0 <img src="{{ asset('img/sale_cs_image.png') }}" title="@lang('site.shop.sale_types.1')"></td>
								<td class="right aligned">{{ $item->total_price }} <img src="{{ asset('img/sale_vote_image.png') }}" title="@lang('site.shop.sale_types.2')"></td>
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
						<th class="right aligned">{{ $cart->getTotalUnitCsPrice() }} <img src="{{ asset('img/sale_cs_image.png') }}" title="@lang('site.shop.sale_types.1')"></th>
						<th class="right aligned">{{ $cart->getTotalUnitVotePrice() }} <img src="{{ asset('img/sale_vote_image.png') }}" title="@lang('site.shop.sale_types.2')"></th>
						<th class="right aligned">{{ $cart->getTotalTtlCsPrice() }} <img src="{{ asset('img/sale_cs_image.png') }}" title="@lang('site.shop.sale_types.1')"></th>
						<th class="right aligned">{{ $cart->getTotalTtlVotePrice() }} <img src="{{ asset('img/sale_vote_image.png') }}" title="@lang('site.shop.sale_types.2')"></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
@endsection

<?php /** @var \App\Helper\Cart $cart */ ?>
<?php /** @var \App\Model\Web\ShopItem $item */ ?>
