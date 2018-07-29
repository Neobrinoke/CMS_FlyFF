@extends('base')

@section('title', trans('trans/title.guild_detail', ['name' => $guild->m_szGuild]))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <h4 class="ui dividing header">@lang('trans/guild.info_divider')</h4>
            <div class="ui segments">
                <div class="ui horizontal segments">
                    <div class="ui segment">
                        @if($guild->has_logo)
                            <img class="ui image guild_logo" src="{{ $guild->logo }}"/>
                        @endif
                        <span>@lang('trans/guild.leader') {{ $guild->leader->m_szName }}</span>
                    </div>
                    <div class="ui segment">
                        <span>@lang('trans/guild.penya') {{ $guild->penyas }}</span>
                    </div>
                    <div class="ui segment">
                        <span>@lang('trans/guild.lvl') {{ $guild->m_nLevel }}</span>
                    </div>
                </div>
            </div>

            <h4 class="ui dividing header">@lang('trans/guild.gvg_divider')</h4>
            <div class="ui segments">
                <div class="ui horizontal segments">
                    <div class="ui segment">
                        <span>@lang('trans/guild.gvg_point') {{ $guild->m_nWinPoint }}</span>
                    </div>
                    <div class="ui segment">
                        <span>@lang('trans/guild.gvg_win') {{ $guild->m_nWin }}</span>
                    </div>
                    <div class="ui segment">
                        <span>@lang('trans/guild.gvg_lose') {{ $guild->m_nLose }}</span>
                    </div>
                    <div class="ui segment">
                        <span>@lang('trans/guild.gvg_surrender') {{ $guild->m_nSurrender }}</span>
                    </div>
                </div>
            </div>

            <h4 class="ui dividing header">@lang('trans/guild.member_divider') ({{ $guild->members->count() }} / {{ $guild->max_members_count }})</h4>
            <table class="ui single line compact selectable table">
                <thead>
                    <tr>
                        <th>@lang('trans/guild.member_ranking.name')</th>
                        <th>@lang('trans/guild.member_ranking.job')</th>
                        <th>@lang('trans/guild.member_ranking.lvl')</th>
                        <th>@lang('trans/guild.member_ranking.gender')</th>
                        <th>@lang('trans/guild.member_ranking.rank')</th>
                        <th>@lang('trans/guild.member_ranking.member_since')</th>
                        <th>@lang('trans/guild.member_ranking.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guild->members as $member)
                        <tr>
                            <td>{{ $member->player->m_szName }}</td>
                            <td><img src="{{ $member->player->job->getImageJob() }}" height="26" title="{{ $member->player->job->getName() }}"></td>
                            <td>{{ $member->player->m_nLevel }}</td>
                            <td><i class="{{ $member->player->sex_icon }} icon" title="{{ $member->player->sex_title }}" style="font-size: 1.5em;"></i></td>
                            <td>
                                @for($i = 0; $i <= (int)$member->m_nClass; $i++)
                                    <img src="{{ $member->rank_logo }}" title="{{ $member->rank_title }}">
                                @endfor
                            </td>
                            <td>{{ $member->CreateTime->toDateString() }}</td>
                            <td>
                                <div class="ui {{ $member->player->onlineInfo->is_online ? 'olive' : 'red' }} label">{{ $member->player->onlineInfo->status }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Character\Guild $guild */ ?>
<?php /** @var \App\Model\Character\GuildMember $member */ ?>