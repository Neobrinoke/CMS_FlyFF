@extends('admin.layout')

@section('title', trans('admin/title.shop.create'))

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

@section('content')
    <form class="ui form" action="{{ route('admin.shop.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="required field">
            <label for="label">@lang('admin/shop.create.form.label')</label>
            <input type="text" name="label" id="label" value="{{ old('label') }}">
        </div>
        <div class="field">
            <label for="image_thumbnail">@lang('admin/shop.create.form.image_thumbnail')</label>
            <input type="file" name="image_thumbnail" id="image_thumbnail">
        </div>
        <div class="field">
            <label for="is_active">@lang('admin/shop.create.form.is_active') <i>@lang('admin/shop.create.form.active_details')</i></label>
            <div class="ui toggle checkbox">
                <input type="checkbox" name="is_active" id="is_active" tabindex="0" class="hidden" {{ old('is_active') ? 'checked' : '' }}>
            </div>
        </div>
        <button class="ui primary floated right button" type="submit">@lang('admin/shop.create.form.submit')</button>
    </form>
@endsection