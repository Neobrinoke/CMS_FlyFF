@extends('admin.layout')

@section('title', trans('admin/title.article.show', ['name' => $article->title]))

@section('header')
    <i class="file alternate icon"></i> - <span>@yield('title')</span>
    <div class="ui breadcrumb right floated">
        <a href="{{ route('admin.home') }}">@lang('admin/title.home')</a>
        <i class="right angle icon divider"></i>
        <a href="{{ route('admin.article.index') }}">@lang('admin/title.article.index')</a>
        <i class="right angle icon divider"></i>
        <span>@yield('title')</span>
    </div>
@endsection

@section('nav-buttons')
    <a class="item" href="{{ route('admin.article.edit', [$article]) }}"><i class="pencil icon"></i> @lang('admin/nav.buttons.article.edit')</a>
    <a class="item" data-modal="#article_destroy_modal"><i class="trash icon"></i> @lang('admin/nav.buttons.article.delete')</a>
    <div class="ui modal" id="article_destroy_modal">
        <div class="header">@lang('admin/article.modal.delete.header', ['name' => $article->title])</div>
        <div class="content">
            @foreach(trans('admin/article.modal.delete.messages') as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
        <div class="actions">
            <div class="ui red cancel labeled icon button"><i class="remove icon"></i>@lang('admin/article.modal.delete.no')</div>
            <div class="ui green ok right labeled icon button" data-submit="#article_destroy_form"><i class="checkmark icon"></i>@lang('admin/article.modal.delete.yes')</div>
            <form action="{{ route('admin.article.destroy', [$article]) }}" method="POST" id="article_destroy_form" style="display: none;">@csrf</form>
        </div>
    </div>
@endsection

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="newspaper outline icon"></i>@yield('title')</h1>
        </div>
        <section class="ui attached fluid clearing segment">
            @if($article->image_header)
                <p><img class="ui centered image" src="{{ $article->image_header }}"></p>
            @endif
            <p>{!! $article->content !!}</p>
            <div class="ui divider"></div>
            <span>{!! $article->detail_info !!}</span>
            @if($article->authorized_comment)
                <span class="ui right floated teal label"><i class="comment outline icon"></i>{{ $article->comment_count }}</span>
            @endif
        </section>

        @if($article->authorized_comment)
            <section class="ui fluid clearing segment">
                <h3 class="ui dividing header">@lang('article.comment.read')</h3>
                @include('article.include.comments', ['comments' => $article->comments, 'parentId' => null])
            </section>
        @endif
    </div>
@endsection

<?php /** @var \App\Model\Web\Article $article */ ?>
<?php /** @var \App\Model\Web\ArticleComment $comment */ ?>