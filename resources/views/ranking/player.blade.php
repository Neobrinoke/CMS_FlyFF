@extends('base')

@section('title', __('site.title.player_ranking'))

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
							<td><img src="{{ $character->getJob()->getImageJob() }}" height="26" title="{{ $character->getJob()->getName() }}"></td>
							<td>{{ $character->m_nLevel }}</td>
							<td><i class="{{ $character->getSexIcon() }} icon" title="{{ $character->getSexTitle() }}" style="font-size: 1.5em;"></i></td>
							<td>{{ sec_to_ydhm($character->TotalPlayTime) }}</td>
							<td>
								@if($character->onlineInfo->isOnline())
									<div class="ui olive label">@lang('site.online_status.online')</div>
								@else
									<div class="ui red label">@lang('site.online_status.offline')</div>
								@endif
							</td>
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
		</div>
	</div>
@endsection

<?php /** @var \App\Model\Character\Character $character */ ?>
<?php /** @var \App\Model\Character\MultiServerInfo $character ->onlineInfo */ ?>