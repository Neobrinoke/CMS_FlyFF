@extends('settings.base')

@section('settings_content')
    <h2 class="ui dividing header">
        @lang('settings.general.edit.title')
    </h2>
    <form class="ui form" action="{{ route('settings.general.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label for="name">@lang('settings.general.edit.name')</label>
                    <input type="text" name="name" id="name" value="{{ $loggedUser->name }}">
                </div>
                <div class="field">
                    <label for="email">@lang('settings.general.edit.email')</label>
                    <input type="email" name="email" id="email" value="{{ $loggedUser->email }}">
                </div>
            </div>
            <div class="field">
                <label for="profile_img">@lang('settings.general.edit.profile_img')</label>
                <input type="file" name="profile_img" id="profile_img">
            </div>
            <div class="two fields">
                <div class="field">
                    <label for="new_password">@lang('settings.general.edit.new_password')</label>
                    <input type="password" name="new_password" id="new_password">
                </div>
                <div class="field">
                    <label for="new_password_confirmation">@lang('settings.general.edit.new_password_confirmation')</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation">
                </div>
            </div>
            <div class="field">
                <label for="password">@lang('settings.general.edit.password')</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="field">
                <div class="ui red label">@lang('settings.general.edit.messages.new_password')</div>
            </div>
            <div class="field">
                <button class="ui primary button right floated" type="submit">@lang('settings.general.edit.submit')</button>
            </div>
        </div>
    </form>
@endsection

<?php /** @var \App\Model\Web\User $loggedUser */ ?>