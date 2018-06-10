@extends('base')

@section('title', __('site.title.player_ranking'))

@section('content')
	<table class="ui single line table">
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
			@foreach($characters as $character)
				<tr>
					<td>{{ current_iteration($characters, $loop) }}</td>
					<td>{{ $character->m_szName }}</td>
					<td><img src="{{ $character->getJob()->getImageJob() }}" height="26"></td>
					<td>{{ $character->m_nLevel }}</td>
					<td><i class="venus icon"></i></td>
					<td>{{ $character->TotalPlayTime }}</td>
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
<?php /** @var \Illuminate\Pagination\LengthAwarePaginator $characters */ ?>