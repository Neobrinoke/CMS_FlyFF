@extends('base')

@section('title', __('site.title.news'))

@section('content')
	<div class="box">
		<div class="ui primary attached message">
			<h1 class="header">@yield('title')</h1>
		</div>
		<div class="ui attached fluid clearing segment">
			<section class="ui unstackable divided items">
				@foreach($articles as $article)
					<article class="item">
						<div class="ui small image">
							<img src="{{ $article->image_thumbnail }}">
						</div>
						<div class="content">
							<div class="header">{{ str_limit($article->title, 50) }}...</div>
							<div class="meta">
								<span class="detail">{{ $article->detail_info }}</span>
							</div>
							<div class="description">
								<p>{!! str_limit($article->content, 150) !!}...</p>
							</div>
							<div class="extra">
								<div class="ui {{ $article->category->color }} label">{{ $article->category->label }}</div>
								<a class="ui right floated primary button" href="{{ route('article.show', [$article, $article->slug]) }}">@lang('site.article.show_more')<i class="right chevron icon"></i></a>
							</div>
						</div>
					</article>
				@endforeach
			</section>
			<div class="ui divider"></div>
			{{ $articles->links() }}
		</div>
	</div>
@endsection

<?php /** @var \App\Model\Web\Article $article */ ?>