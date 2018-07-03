@extends('base')

@section('title', __('trans/title.guild_detail', ['name' => $guild->m_szGuild]))

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
                        @if($guild->hasLogo())
                            <img class="ui image guild_logo" src="{{ $guild->getLogo() }}"/>
                        @endif
                        <span>@lang('trans/guild.leader') {{ $guild->leader->m_szName }}</span>
                    </div>
                    <div class="ui segment">
                        <span>@lang('trans/guild.penya') {{ $guild->m_nGuildGold }}</span>
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

            <h4 class="ui dividing header">@lang('trans/guild.member_divider') ({{ $guild->members->count() }} / {{ $guild->getMaxMembersCount() }})</h4>
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
                            <td><img src="{{ $member->player->getJob()->getImageJob() }}" height="26" title="{{ $member->player->getJob()->getName() }}"></td>
                            <td>{{ $member->player->m_nLevel }}</td>
                            <td><i class="{{ $member->player->getSexIcon() }} icon" title="{{ $member->player->getSexTitle() }}" style="font-size: 1.5em;"></i></td>
                            <td>
                                @for($i = 0; $i <= (int)$member->m_nClass; $i++)
                                    <img src="{{ $member->getRankLogo() }}" title="{{ $member->getRankTitle() }}">
                                @endfor
                            </td>
                            <td>{{ \Carbon\Carbon::createFromTimeString($member->CreateTime)->format('d/m/Y') }}</td>
                            <td>
                                @if($member->player->onlineInfo->isOnline())
                                    <div class="ui olive label">@lang('trans/online_status.online')</div>
                                @else
                                    <div class="ui red label">@lang('trans/online_status.offline')</div>
                                @endif
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
<?php /** @var \App\Model\Character\Character $member ->player */ ?>