@extends('base')

@section('title', __('site.title.player_ranking'))

@section('content')
	<table class="ui single line table">
		<thead>
			<tr>
				<th>#</th>
				<th>@lang('site.ranking.player.name')</th>
				<th>@lang('site.ranking.player.job')</th>
				<th>@lang('site.ranking.player.lvl')</th>
				<th>@lang('site.ranking.player.gender')</th>
				<th>@lang('site.ranking.player.played_time')</th>
				<th>@lang('site.ranking.player.status')</th>
			</tr>
		</thead>
		<tbody>
			@foreach($characters as $character)
				<tr>
					<td>{{ current_iteration($characters, $loop) }}</td>
					<td>{{ $character->m_szName }}</td>
					<td><img src="{{ $character->getJob()->getImageJob() }}" height="26"></td>
					<td>{{ $character->m_nLevel }}</td>
					<td>{!! $character->getSexIcon() !!}</td>
					<td>{{ sec_to_ydhm($character->TotalPlayTime) }}</td>
					<td>{{ $character->serverindex }}</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="7">
					{{ $characters->links() }}
				</th>
			</tr>
		</tfoot>
	</table>
@endsection

<?php /** @var \App\Model\Character\Character $character */ ?>