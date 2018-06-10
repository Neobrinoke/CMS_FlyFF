@extends('base')

@section('title', __('site.title.guild_ranking'))

@section('content')
	<table class="ui single line selectable table">
		<thead>
			<tr>
				<th>#</th>
				<th>@lang('site.ranking.guild.name')</th>
				<th>@lang('site.ranking.guild.lvl')</th>
				<th>@lang('site.ranking.guild.members')</th>
				<th>@lang('site.ranking.guild.leader')</th>
				<th>@lang('site.ranking.guild.logo')</th>
				<th>@lang('site.ranking.guild.created_at')</th>
			</tr>
		</thead>
		<tbody>
			@foreach($guilds as $guild)
				<tr onclick="window.location = '{{ route('guild.show', [$guild]) }}'">
					<td>{{ current_iteration($guilds, $loop) }}</td>
					<td>{{ $guild->m_szGuild }}</td>
					<td>{{ $guild->m_nLevel }}</td>
					<td>
						<div class="ui teal progress ratio" data-value="{{ $guild->members->count() }}" data-total="65">
							<div class="bar">
								<div class="progress"></div>
							</div>
						</div>
					</td>
					<td>{{ $guild->leader->m_szName }}</td>
					<td>{!! $guild->getLogo() !!}</td>
					<td>{{ \Carbon\Carbon::createFromTimeString($guild->CreateTime)->format('d/m/Y') }}</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="7">
					{{ $guilds->links() }}
				</th>
			</tr>
		</tfoot>
	</table>
@endsection

<?php /** @var \App\Model\Character\Guild $guild */ ?>