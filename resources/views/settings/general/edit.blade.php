@extends('settings.base')

@section('settings_content')
    <h2 class="ui dividing header">
        @lang('trans/settings.general.edit.title')
    </h2>
    <form class="ui form" action="{{ route('settings.general.update') }}" method="POST">
        @csrf
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label for="name">@lang('trans/settings.general.edit.name')</label>
                    <input type="text" name="name" id="name" value="{{ $loggedUser->name }}">
                </div>
                <div class="field">
                    <label for="email">@lang('trans/settings.general.edit.email')</label>
                    <input type="email" name="email" id="email" value="{{ $loggedUser->email }}">
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label for="password">@lang('trans/settings.general.edit.password')</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="field">
                    <label for="password_confirmation">@lang('trans/settings.general.edit.password_confirmation')</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>
            </div>
            <div class="field">
                <button class="ui primary button right floated" type="submit">@lang('trans/settings.general.edit.submit')</button>
            </div>
        </div>
    </form>
@endsection

<?php /** @var \App\Model\Web\User $loggedUser */ ?>