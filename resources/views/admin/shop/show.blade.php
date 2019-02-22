@extends('admin.layout')

@section('title', trans('admin/title.shop.show', ['name' => $shop->label]))

@section('header')
    <i class="shop icon"></i> - <span>@yield('title')</span>
    <div class="ui breadcrumb right floated">
        <a href="{{ route('admin.home') }}">@lang('admin/title.home')</a>
        <i class="right angle icon divider"></i>
        <a href="{{ route('admin.shop.index') }}">@lang('admin/title.shop.index')</a>
        <i class="right angle icon divider"></i>
        <span>@yield('title')</span>
    </div>
@endsection

@section('nav-buttons')
    <a class="item" href="{{ route('admin.shop.edit', [$shop]) }}"><i class="pencil icon"></i> @lang('admin/nav.buttons.shop.edit')</a>
    <a class="item" data-modal="#shop_destroy_modal"><i class="trash icon"></i> @lang('admin/nav.buttons.shop.delete')</a>
    <div class="ui modal" id="shop_destroy_modal">
        <div class="header">@lang('admin/shop.modal.delete.header', ['name' => $shop->label])</div>
        <div class="content">
            @foreach(trans('admin/shop.modal.delete.messages') as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
        <div class="actions">
            <div class="ui red cancel labeled icon button"><i class="remove icon"></i>@lang('admin/shop.modal.delete.no')</div>
            <div class="ui green ok right labeled icon button" data-submit="#shop_destroy_form"><i class="checkmark icon"></i>@lang('admin/shop.modal.delete.yes')</div>
            <form action="{{ route('admin.shop.destroy', [$shop]) }}" method="POST" id="shop_destroy_form" style="display: none;">@csrf</form>
        </div>
    </div>
@endsection

@section('content')
    <div class="ui segment">
        <img src="{{ $shop->image_thumbnail }}" height="150px">
        <div class="ui {{ $shop->is_active ? 'olive' : 'red' }} label">{{ $shop->status }}</div>
    </div>

    <table class="ui celled table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Price</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Deleted_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <img class="ui middle aligned image" src="{{ $item->sale_image }}" title="{{ trans('shop.sale_types')[$item->sale_type] }}">
                        {{ $item->price }}
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>{{ $item->deleted_at }}</td>
                    <td>{{ $item->deleted_at }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8">
                    {{ $items->appends(request()->except('page'))->links() }}
                </th>
            </tr>
        </tfoot>
    </table>
@endsection

<?php /** @var \App\Model\Web\Shop $shop */ ?>
<?php /** @var \App\Model\Web\ShopItem $item */ ?>