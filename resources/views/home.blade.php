@extends('base')

@section('title', __('site.nav.home'))

@section('content')
	<div class="box">
		<div class="ui primary attached message">
			<h1 class="header">@yield('title')</h1>
		</div>
		<div class="ui attached fluid clearing segment">
			<div class="ui unstackable divided items">
				@foreach($articles->take(3) as $article)
					<div class="item">
						<div class="ui small image">
							<img src="https://semantic-ui.com/images/wireframe/image.png">
						</div>
						<div class="content">
							<div class="header">{{ substr($article->title, 0, 50) }}...</div>
							<div class="meta">
								<span class="detail">Par Neobrinoke, Le 25/03/2015 à 18:25</span>
							</div>
							<div class="description">
								<p>{!! substr($article->content, 0, 150) !!}...</p>
							</div>
							<div class="extra">
								<div class="ui label">Mise à jour</div>
								<div class="ui right floated primary button">Voir plus sur l'article<i class="right chevron icon"></i></div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<div class="ui divider"></div>
			@if($articles->count() > 3)
				<a href="{{ route('article.index', ['page' => 2]) }}" class="ui right floated button green basic">@lang('site.article.show_more')<i class="right chevron icon"></i></a>
			@endif
		</div>
	</div>
@endsection

<?php /** @var \Illuminate\Support\Collection $articles */ ?>
<?php /** @var \App\Model\Web\Article $article */ ?>