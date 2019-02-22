@extends('admin.layout')

@section('title', trans('admin/title.shop.index'))

@section('header')
    <i class="shop icon"></i> - <span>@yield('title')</span>
    <div class="ui breadcrumb right floated">
        <a href="{{ route('admin.home') }}">@lang('admin/title.home')</a>
        <i class="right angle icon divider"></i>
        <span>@yield('title')</span>
    </div>
@endsection

@section('nav-buttons')
    <a class="item" href="{{ route('admin.shop.create') }}"><i class="plus icon"></i> @lang('admin/nav.buttons.shop.add')</a>
@endsection

@section('content')
    <table class="ui compact celled table">
        <thead>
            <tr>
                <th>@lang('admin/shop.index.table.id')</th>
                <th>@lang('admin/shop.index.table.label')</th>
                <th>@lang('admin/shop.index.table.image_thumbnail')</th>
                <th>@lang('admin/shop.index.table.state')</th>
                <th>@lang('admin/shop.index.table.created_at')</th>
                <th class="right aligned collapsing">@lang('admin/shop.index.table.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->id }}</td>
                    <td>{{ $shop->label }}</td>
                    <td><img src="{{ $shop->image_thumbnail }}" height="35px"></td>
                    <td>
                        <div class="ui {{ $shop->is_active ? 'olive' : 'red' }} label">{{ $shop->status }}</div>
                    </td>
                    <td>
                        <time datetime="{{ $shop->created_at }}">{{ $shop->created_at }}</time>
                    </td>
                    <td class="right aligned collapsing">
                        <a href="{{ route('admin.shop.show', [$shop]) }}" class="ui purple mini compact button icon" data-tooltip="@lang('admin/shop.index.table.actions.show')" data-position="left center" data-inverted=true><i class="eye icon"></i></a>
                        <a href="{{ route('admin.shop.edit', [$shop]) }}" class="ui primary mini compact button icon" data-tooltip="@lang('admin/shop.index.table.actions.edit')" data-position="left center" data-inverted=true><i class="pencil icon"></i></a>
                        <a class="ui red mini compact button icon" data-modal="#shop_{{ $shop->id }}_destroy_modal" data-tooltip="@lang('admin/shop.index.table.actions.delete')" data-position="left center" data-inverted=true><i class="trash icon"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6">
                    {{ $shops->appends(request()->except('page'))->links() }}
                </th>
            </tr>
        </tfoot>
    </table>

    @foreach($shops as $shop)
        <div class="ui modal" id="shop_{{ $shop->id }}_destroy_modal">
            <div class="header">@lang('admin/shop.modal.delete.header', ['name' => $shop->label])</div>
            <div class="content">
                @foreach(trans('admin/shop.modal.delete.messages') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
            <div class="actions">
                <div class="ui red cancel labeled icon button"><i class="remove icon"></i>@lang('admin/shop.modal.delete.no')</div>
                <div class="ui green ok right labeled icon button" data-submit="#shop_{{ $shop->id }}_destroy_form"><i class="checkmark icon"></i>@lang('admin/shop.modal.delete.yes')</div>
                <form action="{{ route('admin.shop.destroy', [$shop]) }}" method="POST" id="shop_{{ $shop->id }}_destroy_form" style="display: none;">@csrf</form>
            </div>
        </div>
    @endforeach
@endsection

<?php /** @var \App\Model\Web\Shop $shop */ ?>