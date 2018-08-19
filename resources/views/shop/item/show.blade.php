@extends('layout')

@section('title', trans('title.shop_item_detail', ['name' => $item->title]))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <div class="ui left floated" style="max-width: 200px; margin-right: 15px;">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($item->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ $image->image }}" width="200" height="350">
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="ui left floated">
                <p>{{ $item->description }} </p>
                <p>
                    <img class="ui middle aligned image" src="{{ $item->sale_image }}" title="{{ trans('shop.sale_types')[$item->sale_type] }}">
                    <span>{{ $item->price }}</span>
                </p>
                @auth
                    <form class="ui form" action="{{ route('shop.cart.store', [$item]) }}" method="POST">
                        @csrf
                        <div class="field">
                            <label for="quantity">@lang('shop.quantity')</label>
                            <input type="number" name="quantity" id="quantity" value="1">
                        </div>
                        <button class="ui fluid primary button" type="submit">@lang('shop.add_to_cart')</button>
                    </form>
                @else
                    @component('message.error')
                        @lang('shop.cart.need_login')
                    @endcomponent
                @endauth
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endsection

<?php /** @var \App\Model\Web\ShopItem $item */ ?>
<?php /** @var \App\Model\Web\ShopImage $image */ ?>
