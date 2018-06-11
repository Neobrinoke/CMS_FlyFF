@extends('base')

@section('title', __('site.title.news'))

@section('content')
	<div class="box">
		<div class="ui primary attached message">
			<h1 class="header">@yield('title')</h1>
		</div>
		<div class="ui attached fluid clearing segment">
			<div class="ui styled fluid accordion">
				@foreach($articles as $article)
					<div class="title {{ $loop->first ? 'active' : '' }}"><i class="dropdown icon"></i>{{ $article->title }}</div>
					<div class="content {{ $loop->first ? 'active' : '' }}">
						<p class="transition {{ $loop->first ? 'visible' : '' }}">{!! $article->content !!}</p>
					</div>
				@endforeach
			</div>
			{{ $articles->links() }}
		</div>
	</div>
@endsection

<?php /** @var \Illuminate\Support\Collection $articles */ ?>
<?php /** @var \App\Model\Web\Article $article */ ?>