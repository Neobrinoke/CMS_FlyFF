@extends('settings.base')

@section('settings_content')
    <h2 class="ui dividing header">
        @lang('trans/settings.general.index.title')
        <a href="{{ route('settings.general.edit') }}" class="ui label right floated" style="margin-top: 3px;">
            <i class="edit icon"></i>@lang('trans/settings.general.index.buttons.edit')
        </a>
    </h2>
    <div class="ui stackable grid">
        <div class="four wide column">
            <img class="ui small image left floated" src="{{ $loggedUser->avatar_image }}">
        </div>
        <div class="twelve wide column">
            <table class="ui very basic compact table">
                <tbody>
                    <tr>
                        <td>@lang('trans/settings.general.index.email')</td>
                        <td>{{ $loggedUser->email }}</td>
                    </tr>
                    <tr>
                        <td>@lang('trans/settings.general.index.register_date')</td>
                        <td>{{ $loggedUser->created_at->toDateString() }}</td>
                    </tr>
                    <tr>
                        <td>@lang('trans/settings.general.index.update_date')</td>
                        <td>{{ $loggedUser->updated_at->toDateString() }}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('img/sale_cs_image.png') }}"> @lang('trans/shop.sale_types.1')</td>
                        <td>{{ $loggedUser->cash_point }}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('img/sale_vote_image.png') }}"> @lang('trans/shop.sale_types.2')</td>
                        <td>{{ $loggedUser->vote_point }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Web\User $loggedUser */ ?>