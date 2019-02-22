@extends('layout')

@section('title', trans('title.shop_detail', ['name' => $shop->label]))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <section class="ui clearing segment">
                <h3 class="ui dividing header">@lang('shop.search.header')</h3>
                <form class="ui form" action="{{ route('shop.show', [$shop, $shop->slug]) }}" method="GET">
                    <div class="three fields">
                        <div class="field">
                            <label for="title">@lang('shop.search.title')</label>
                            <input type="text" name="title" id="title" value="{{ request('title') }}">
                        </div>
                        <div class="field">
                            <label for="price_start">@lang('shop.search.price_min')</label>
                            <input type="number" name="price_start" id="price_start" placeholder="0" value="{{ request('price_start') }}">
                        </div>
                        <div class="field">
                            <label for="price_start">@lang('shop.search.price_max')</label>
                            <input type="number" name="price_end" id="price_end" placeholder="500" value="{{ request('price_end') }}">
                        </div>
                    </div>
                    <div class="three fields">
                        <div class="field">
                            <label for="category_id">@lang('shop.search.category')</label>
                            <select multiple="" class="ui dropdown" name="category_id[]" id="category_id">
                                <option value="">@lang('shop.search.select_categories')</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ collect(request('category_id'))->contains($category->id) ? 'selected' : '' }}>{{ $category->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label for="sale_type">@lang('shop.search.devise')</label>
                            <select class="ui dropdown" name="sale_type" id="sale_type">
                                <option value="">@lang('shop.search.select_devises')</option>
                                @foreach($saleTypes as $saleType)
                                    <option value="{{ $saleType }}" {{ (int)request('sale_type') === $saleType ? 'selected' : '' }}>@lang('shop.sale_types.' . $saleType)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label for="sort_by">@lang('shop.search.sort_by')</label>
                            <select class="ui dropdown" name="sort_by" id="sort_by">
                                <option value="">@lang('shop.search.select_sort')</option>
                                @foreach($sortList as $sort)
                                    <option value="{{ $sort }}" {{ request('sort_by') === $sort ? 'selected' : '' }}>@lang('shop.search.sort_list.' . $sort)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="ui primary right floated right labeled icon button" type="submit"><i class="right arrow icon"></i>@lang('shop.search.submit')</button>
                    <button id="reset_form" class="ui orange right floated right labeled icon button"><i class="remove icon"></i>@lang('shop.search.clear_form')</button>
                </form>
            </section>

            @if($canNotFind)
                <div class="ui error message">@lang('shop.search.can_not_find')</div>
            @endif

            <section class="ui three stackable cards">
                @foreach($items as $item)
                    <div class="ui card">
                        <div class="content">
                            <img class="ui mini left floated image" src="{{ $item->image_thumbnail }}">
                            <p class="right aligned header">{{ $item->title }}</p>
                            <div class="right aligned meta">
                                <span>{{ $item->price }}</span>
                                <img class="ui middle aligned image" src="{{ $item->sale_image }}" title="{{ trans('shop.sale_types')[$item->sale_type] }}">
                            </div>
                            <div class="meta">
                            </div>
                        </div>
                        <a class="ui compact bottom attached primary right labeled icon button" href="{{ route('shop.item', [$shop, $item, $item->slug]) }}"><i class="right arrow icon"></i>@lang('shop.show_item_details')</a>
                    </div>
                @endforeach
            </section>

            <div class="ui divider"></div>
            {{ $items->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Web\Shop $shop */ ?>
<?php /** @var \App\Model\Web\ShopItem $item */ ?>
