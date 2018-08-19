@extends('layout')

@section('title', trans('title.player_ranking'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="sort amount up icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <table class="ui single line compact selectable table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('ranking.player.name')</th>
                        <th>@lang('ranking.player.job')</th>
                        <th>@lang('ranking.player.lvl')</th>
                        <th>@lang('ranking.player.gender')</th>
                        <th>@lang('ranking.player.played_time')</th>
                        <th>@lang('ranking.player.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($characters as $character)
                        <tr>
                            <td>{{ current_iteration($characters, $loop) }}</td>
                            <td>{{ $character->m_szName }}</td>
                            <td><img src="{{ $character->job->getImageJob() }}" height="26" title="{{ $character->job->getName() }}"></td>
                            <td>{{ $character->m_nLevel }}</td>
                            <td><i class="{{ $character->sex_icon }} icon" title="{{ $character->sex_title }}" style="font-size: 1.5em;"></i></td>
                            <td>{{ $character->total_time_played }}</td>
                            <td>
                                <div class="ui {{ $character->onlineInfo->is_online ? 'olive' : 'red' }} label">{{ $character->onlineInfo->status }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7">
                            {{ $characters->appends(request()->except('page'))->links() }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Character\Character $character */ ?>