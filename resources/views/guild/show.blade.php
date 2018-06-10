@extends('base')

@section('title', __('site.nav.guild', ['name' => $guild->m_szGuild]))

@section('content')
	<h4 class="ui dividing header">@lang('site.guild.info_divider')</h4>
	<div class="ui segments">
		<div class="ui horizontal segments">
			<div class="ui segment">
				@if($guild->hasLogo())
					<img class="ui image guild_logo" src="{{ $guild->getLogo() }}"/>
				@endif
				<span>@lang('site.guild.leader') {{ $guild->leader->m_szName }}</span>
			</div>
			<div class="ui segment">
				<span>@lang('site.guild.penya') {{ $guild->m_nGuildGold }}</span>
			</div>
			<div class="ui segment">
				<span>@lang('site.guild.lvl') {{ $guild->m_nLevel }}</span>
			</div>
		</div>
	</div>

	<h4 class="ui dividing header">@lang('site.guild.gs_divider')</h4>
	<div class="ui segments">
		<div class="ui horizontal segments">
			<div class="ui segment">
				<span>@lang('site.guild.gs_point') {{ $guild->m_nWinPoint }}</span>
			</div>
			<div class="ui segment">
				<span>@lang('site.guild.gs_win') {{ $guild->m_nWin }}</span>
			</div>
			<div class="ui segment">
				<span>@lang('site.guild.gs_lose') {{ $guild->m_nLose }}</span>
			</div>
			<div class="ui segment">
				<span>@lang('site.guild.gs_surrender') {{ $guild->m_nSurrender }}</span>
			</div>
		</div>
	</div>

	<h4 class="ui dividing header">@lang('site.guild.member_divider')</h4>
	<table class="ui single line selectable table">
		<thead>
			<tr>
				<th>@lang('site.guild.member_ranking.name')</th>
				<th>@lang('site.guild.member_ranking.job')</th>
				<th>@lang('site.guild.member_ranking.lvl')</th>
				<th>@lang('site.guild.member_ranking.gender')</th>
				<th>@lang('site.guild.member_ranking.rank')</th>
				<th>@lang('site.guild.member_ranking.member_since')</th>
				<th>@lang('site.guild.member_ranking.status')</th>
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
					<td>{{ $member->player->CreateTime }}</td>
					<td>{{ $member->player->m_szName }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

<?php /** @var \App\Model\Character\Guild $guild */ ?>
<?php /** @var \App\Model\Character\GuildMember $member */ ?>
<?php /** @var \App\Model\Character\Character $member ->player */ ?>