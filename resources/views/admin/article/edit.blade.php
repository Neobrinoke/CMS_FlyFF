@extends('admin.layout')

@section('title', trans('admin/title.article.edit', ['name' => $article->title]))

@section('header')
    <i class="shop icon"></i> - <span>@yield('title')</span>
    <div class="ui breadcrumb right floated">
        <a href="{{ route('admin.home') }}">@lang('admin/title.home')</a>
        <i class="right angle icon divider"></i>
        <a href="{{ route('admin.article.index') }}">@lang('admin/title.article.index')</a>
        <i class="right angle icon divider"></i>
        <span>@yield('title')</span>
    </div>
@endsection

@section('content')
    <form class="ui form" action="{{ route('admin.article.update', [$article]) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="required field">
            <label for="title">@lang('admin/article.edit.form.title')</label>
            <input type="text" name="title" id="title" value="{{ old('label') ?: $article->title }}" required>
        </div>
        <div class="required field">
            <label for="image_thumbnail">@lang('admin/article.edit.form.image_thumbnail')</label>
            <img src="{{ $article->image_thumbnail }}" height="100px">
            <input type="file" name="image_thumbnail" id="image_thumbnail" required>
        </div>
        <div class="required field">
            <label for="image_thumbnail">@lang('admin/article.edit.form.image_header')</label>
            <img src="{{ $article->image_header }}" height="100px">
            <input type="file" name="image_header" id="image_header" required>
        </div>
        <div class="required field">
            <label for="category_id">@lang('admin/article.edit.form.category')</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"{{ $article->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->label }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="required field">
            <label for="content">@lang('admin/article.edit.form.content')</label>
            <textarea type="text" name="content" id="content">{{ old('content') ?: $article->content }}</textarea>
        </div>
        <div class="field">
            <label for="authorized_comment">@lang('admin/article.edit.form.authorized_comment')</label>
            <div class="ui toggle checkbox">
                <input type="checkbox" name="authorized_comment" id="authorized_comment" tabindex="0"
                       class="hidden" {{ (old('authorized_comment') ?: $article->authorized_comment) ? 'checked' : '' }}>
            </div>
        </div>
        <button class="ui primary floated right button" type="submit">@lang('admin/article.edit.form.submit')</button>
    </form>
@endsection

<?php /** @var \App\Model\Web\Article $article */ ?>
<?php /** @var \App\Model\Web\ArticleCategory $category */ ?>
