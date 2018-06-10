@extends('base')

@section('title', $controller === 'home' ? __('site.nav.home') : __('site.title.news'))

@section('content')
	<div class="ui styled fluid accordion">
		@foreach($articles->take(5) as $article)
			<div class="title {{ $loop->first ? 'active' : '' }}"><i class="dropdown icon"></i>{{ $article->title }}</div>
			<div class="content {{ $loop->first ? 'active' : '' }}">
				<p class="transition {{ $loop->first ? 'visible' : '' }}">{!! $article->content !!}</p>
			</div>
		@endforeach
	</div>
	@if($controller === 'home')
		@if($articles->count() > 5)
			<a class="ui right labeled icon green very basic button right floated" href="{{ route('article.index', ['page' => 2]) }}"><i class="right arrow icon"></i>@lang('site.article.show_more')</a>
		@endif
	@else
		{{ $articles->links() }}
	@endif
@endsection

<?php /** @var \Illuminate\Support\Collection $articles */ ?>
<?php /** @var \App\Model\Web\Article $article */ ?>