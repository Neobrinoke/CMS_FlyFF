@extends('base')

@section('title', trans('trans/title.ticket'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="ticket icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <form class="ui form" action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label for="title">@lang('trans/ticket.create.form.title')</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}">
                    </div>
                    <div class="field">
                        <label for="category_id">@lang('trans/ticket.create.form.category')</label>
                        <select class="ui dropdown" name="category_id" id="category_id">
                            <option value="">@lang('trans/ticket.create.form.select_category')</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label for="content">@lang('trans/ticket.create.form.content')</label>
                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                </div>
                <div class="field">
                    <label for="attachments">@lang('trans/ticket.create.form.attachments')</label>
                    <input type="file" name="attachments[]" id="attachments" multiple>
                </div>
                <div class="field">
                    <button class="ui primary right floated button" type="submit">@lang('trans/ticket.create.form.submit')</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Web\TicketCategory $category */ ?>