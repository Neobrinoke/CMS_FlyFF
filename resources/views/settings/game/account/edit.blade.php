@extends('settings.base')

@section('settings_content')
    <h2 class="ui dividing header">
        @lang('settings.game.account.edit.title', ['account' => $account->account])
    </h2>
    <form class="ui form" action="{{ route('settings.game.account.update', [$account]) }}" method="POST">
        @csrf
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label for="new_password">@lang('settings.game.account.edit.new_password')</label>
                    <input type="password" name="new_password" id="new_password">
                </div>
                <div class="field">
                    <label for="new_password_confirmation">@lang('settings.game.account.edit.new_password_confirmation')</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation">
                </div>
            </div>
            <div class="field">
                <label for="password">@lang('settings.game.account.edit.password')</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="field">
                <button class="ui primary button right floated" type="submit">@lang('settings.game.account.edit.submit')</button>
            </div>
        </div>
    </form>
@endsection

<?php /** @var \App\Model\Web\User $loggedUser */ ?>
<?php /** @var \App\Model\Account\Account $account */ ?>