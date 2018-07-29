@extends('settings.base')

@section('settings_content')
    <h2 class="ui dividing header">
        @lang('trans/settings.game.account.index.title')
        <a href="{{ route('settings.game.account.create') }}" class="ui label right floated" style="margin-top: 3px;">
            <i class="add icon"></i>@lang('trans/settings.game.account.index.buttons.add')
        </a>
    </h2>
    <table class="ui very basic compact table">
        <thead>
            <tr>
                <th>@lang('trans/settings.game.account.index.account')</th>
                <th>@lang('trans/settings.game.account.index.char_count')</th>
                <th>@lang('trans/settings.game.account.index.creation_date')</th>
                <th>@lang('trans/settings.game.account.index.status')</th>
                <th>@lang('trans/settings.game.account.index.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loggedUser->accounts as $account)
                <tr>
                    <td>{{ $account->account }}</td>
                    <td>{{ $account->characters->count() }} / {{ env('MAX_PLAYER_PER_ACCOUNT') }}</td>
                    <td>{{ $account->detail->regdate->toDateString() }}</td>
                    <td>
                        <div class="ui {{ $account->is_banned ? 'red' : 'olive' }} label">{{ $account->status }}</div>
                    </td>
                    <td>
                        @if(!$account->is_banned)
                            <a href="{{ route('settings.game.account.edit', [$account]) }}" class="ui green compact icon button"><i class="edit icon"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<?php /** @var \App\Model\Web\User $loggedUser */ ?>
<?php /** @var \App\Model\Account\Account $account */ ?>