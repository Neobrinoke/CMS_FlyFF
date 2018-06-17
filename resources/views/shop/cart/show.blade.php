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
						<th>Image</th>
						<th>Nom</th>
						<th>Qte</th>
						<th>Prix Unit.</th>
						<th>Prix Ttl.</th>
					</tr>
				</thead>
				<tbody>
					@php($unitPrice = 0)
					@php($ttlPrice = 0)
					@foreach($items as $item)
						<form class="ui form" action="{{ route('shop.cart.destroy', [$item]) }}" method="POST">
							@csrf
							<tr>
								<td style="max-width: 28px;"><button class="ui red basic icon button" type="submit"><i class="remove icon"></i></button></td>
								<td><img src="{{ $item->image_thumbnail }}" alt="" width="32" height="32"></td>
								<td><a href="{{ route('shop.item', [$item->shop, $item, $item->slug]) }}">{{ $item->title }}</a></td>
								<td>{{ $item->qte }}</td>
								<td>{{ $item->price }}</td>
								<td>{{ $item->price * $item->qte }}</td>
							</tr>
							@php($unitPrice += $item->price)
							@php($ttlPrice += ($item->price * $item->qte))
						</form>
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>{{ $unitPrice }}</td>
						<td>{{ $ttlPrice }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection

<?php /** @var \App\Model\Web\ShopItem $item */ ?>
