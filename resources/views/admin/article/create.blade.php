@extends('admin.layout')

@section('title', trans('admin/title.article.create'))

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
    <form class="ui form" action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="author_id" id="author_id" value="1">
        <div class="required field">
            <label for="title">@lang('admin/article.create.form.title')</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>
        <div class="required field">
            <label for="image_thumbnail">@lang('admin/article.create.form.image_thumbnail')</label>
            <input type="file" name="image_thumbnail" id="image_thumbnail" required>
        </div>
        <div class="required field">
            <label for="image_thumbnail">@lang('admin/article.create.form.image_header')</label>
            <input type="file" name="image_header" id="image_header" required>
        </div>
        <div class="required field">
            <label for="category_id">@lang('admin/article.create.form.category')</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->label }}</option>
                @endforeach
            </select>
        </div>
        <div class="required field">
            <label for="content">@lang('admin/article.create.form.content')</label>
            <textarea type="text" name="content" id="content" required>{{ old('content') }}</textarea>
        </div>
        <div class="field">
            <label for="authorized_comment">@lang('admin/article.create.form.authorized_comment')</label>
            <div class="ui toggle checkbox">
                <input type="checkbox" name="authorized_comment" id="authorized_comment" tabindex="0" class="hidden" {{ old('authorized_comment') ? 'checked' : '' }}>
            </div>
        </div>
        <button class="ui primary floated right button" type="submit">@lang('admin/article.create.form.submit')</button>
    </form>
@endsection

<?php /** @var \App\Model\Web\ArticleCategory $category */ ?>
