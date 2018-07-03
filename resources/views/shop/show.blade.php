@extends('base')

@section('title', trans('trans/title.shop_detail', ['name' => $shop->label]))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <section class="ui clearing segment">
                <h3 class="ui dividing header">@lang('trans/shop.search.header')</h3>
                <form id="search_shop_form" class="ui form" action="{{ route('shop.show', [$shop, $shop->slug]) }}" method="GET">
                    <div class="fields">
                        <div class="six wide field">
                            <label for="title">@lang('trans/shop.search.title')</label>
                            <input type="text" name="title" id="title" value="{{ request('title') }}">
                        </div>
                        <div class="ten wide field">
                            <label for="price_start">@lang('trans/shop.search.price')</label>
                            <div class="two fields">
                                <div class="field">
                                    <input type="number" name="price_start" id="price_start" placeholder="0" value="{{ request('price_start') }}">
                                </div>
                                <div class="field">
                                    <input type="number" name="price_end" id="price_end" placeholder="500" value="{{ request('price_end') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="three fields">
                        <div class="field">
                            <label for="category_id">@lang('trans/shop.search.category')</label>
                            <select multiple="" class="ui dropdown" name="category_id[]" id="category_id">
                                <option value="">@lang('trans/shop.search.select_categories')</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ collect(request('category_id'))->contains($category->id) ? 'selected' : '' }}>{{ $category->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label for="sale_type">@lang('trans/shop.search.devise')</label>
                            <select class="ui dropdown" name="sale_type" id="sale_type">
                                <option value="">@lang('trans/shop.search.select_devises')</option>
                                @foreach(trans('trans/shop.sale_types') as $key => $value)
                                    <option value="{{ $key }}" {{ intval(request('sale_type')) === $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label for="sort_by">@lang('trans/shop.search.sort_by')</label>
                            <select class="ui dropdown" name="sort_by" id="sort_by">
                                <option value="">@lang('trans/shop.search.select_sort')</option>
                                @foreach(trans('trans/shop.search.sort_list') as $key => $value)
                                    <option value="{{ $key }}" {{ request('sort_by') === $key ? 'selected' : '' }}>{!! $value !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="ui primary right floated right labeled icon button" type="submit"><i class="right arrow icon"></i>@lang('trans/shop.search.submit')</button>
                    <button id="reset_form" class="ui orange right floated right labeled icon button"><i class="remove icon"></i>@lang('trans/shop.search.clear_form')</button>
                </form>
            </section>


            @if($canNotFind)
                <div class="ui error message">@lang('trans/shop.search.can_not_find')</div>
            @endif

            <section class="ui three stackable cards">
                @foreach($items as $item)
                    <div class="ui card">
                        <div class="content">
                            <img class="ui mini left floated image" src="{{ $item->image_thumbnail }}">
                            <p class="right aligned header">{{ $item->title }} {{ $item->category->label }}</p>
                            <div class="right aligned meta">
                                <span>{{ $item->price }}</span>
                                <img class="ui middle aligned image" src="{{ $item->sale_image }}" title="{{ trans('trans/shop.sale_types')[$item->sale_type] }}">
                            </div>
                            <div class="meta">
                            </div>
                        </div>
                        <a class="ui compact bottom attached primary right labeled icon button" href="{{ route('shop.item', [$shop, $item, $item->slug]) }}"><i class="right arrow icon"></i>@lang('trans/shop.show_item_details')</a>
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
