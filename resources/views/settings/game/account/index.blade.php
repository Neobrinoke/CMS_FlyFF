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
                <th>Identifiant</th>
                <th>Personnages</th>
                <th>Date de création</th>
                <th>Etat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loggedUser->accounts as $account)
                <tr>
                    <td>{{ $account->account }}</td>
                    <td>{{ $account->characters->count() }} / {{ env('MAX_PLAYER_PER_ACCOUNT') }}</td>
                    <td>{{ $account->detail->regdate->toDateString() }}</td>
                    <td>@lang('trans/settings.general.index.statuses.valid')</td>
                    <td>
                        <a href="{{ route('settings.game.account.edit', [$account]) }}" class="ui green compact icon button"><i class="edit icon"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<?php /** @var \App\Model\Web\User $loggedUser */ ?>
<?php /** @var \App\Model\Account\Account $account */ ?>