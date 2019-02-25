@extends('admin.layout')

@section('title', trans('admin/title.article.index'))

@section('header')
    <i class="file alternate icon"></i> - <span>@yield('title')</span>
    <div class="ui breadcrumb right floated">
        <a href="{{ route('admin.home') }}">@lang('admin/title.home')</a>
        <i class="right angle icon divider"></i>
        <span>@yield('title')</span>
    </div>
@endsection

@section('nav-buttons')
    <a class="item" href="{{ route('admin.article.create') }}"><i
                class="plus icon"></i> @lang('admin/nav.buttons.article.add')</a>
@endsection

@section('content')
    <table class="ui compact celled table">
        <thead>
        <tr>
            <th>@lang('admin/article.index.table.id')</th>
            <th>@lang('admin/article.index.table.titre')</th>
            <th>@lang('admin/article.index.table.authorized_comment')</th>
            <th>@lang('admin/article.index.table.created_at')</th>
            <th class="right aligned collapsing">@lang('admin/article.index.table.action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->getAuthorizedCommentLabelAttribute() }}</td>
                <td>
                    <time datetime="{{ $article->created_at }}">{{ $article->created_at }}</time>
                </td>
                <td class="right aligned collapsing">
                    <a href="{{ route('admin.article.show', [$article]) }}" class="ui purple mini compact button icon"
                       data-tooltip="@lang('admin/article.index.table.actions.show')" data-position="left center"
                       data-inverted=true><i class="eye icon"></i></a>
                    <a href="{{ route('admin.article.edit', [$article]) }}" class="ui primary mini compact button icon"
                       data-tooltip="@lang('admin/article.index.table.actions.edit')" data-position="left center"
                       data-inverted=true><i class="pencil icon"></i></a>
                    <a class="ui red mini compact button icon" data-modal="#article_{{ $article->id }}_destroy_modal"
                       data-tooltip="@lang('admin/article.index.table.actions.delete')" data-position="left center"
                       data-inverted=true><i class="trash icon"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="6">
                {{ $articles->appends(request()->except('page'))->links() }}
            </th>
        </tr>
        </tfoot>
    </table>

    @foreach($articles as $article)
        <div class="ui modal" id="article_{{ $article->id }}_destroy_modal">
            <div class="header">@lang('admin/article.modal.delete.header', ['name' => $article->title])</div>
            <div class="content">
                @foreach(trans('admin/article.modal.delete.messages') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
            <div class="actions">
                <div class="ui red cancel labeled icon button"><i
                            class="remove icon"></i>@lang('admin/article.modal.delete.no')</div>
                <div class="ui green ok right labeled icon button"
                     data-submit="#article_{{ $article->id }}_destroy_form"><i
                            class="checkmark icon"></i>@lang('admin/article.modal.delete.yes')</div>
                <form action="{{ route('admin.article.destroy', [$article]) }}" method="POST"
                      id="article_{{ $article->id }}_destroy_form" style="display: none;">@csrf</form>
            </div>
        </div>
    @endforeach
@endsection

<?php /** @var \App\Model\Web\Article $article */ ?>