@extends('settings.base')

@section('settings_content')
    <h2 class="ui dividing header">
        @lang('settings.game.account.create.title')
    </h2>
    <form class="ui form" action="{{ route('settings.game.account.store') }}" method="POST">
        @csrf
        <div class="field">
            <div class="field">
                <label for="account">@lang('settings.game.account.create.account')</label>
                <input type="text" name="account" id="account" value="{{ old('account') }}">
            </div>
            <div class="two fields">
                <div class="field">
                    <label for="password">@lang('settings.game.account.create.password')</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="field">
                    <label for="password_confirmation">@lang('settings.game.account.create.password_confirmation')</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>
            </div>
            <div class="field">
                <button class="ui primary button right floated" type="submit">@lang('settings.game.account.create.submit')</button>
            </div>
        </div>
    </form>
@endsection

<?php /** @var \App\Model\Web\User $loggedUser */ ?>
<?php /** @var \App\Model\Account\Account $account */ ?>