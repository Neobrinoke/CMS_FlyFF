@extends('base')

@section('title', __('site.title.news'))

@section('content')
	<div class="box">
		<div class="ui primary attached message">
			<h1 class="header">@yield('title')</h1>
		</div>
		<div class="ui attached fluid clearing segment">
			<h3 class="ui dividing header">{{ $article->title }}</h3>
			<p><img class="ui centered image" src="{{ $article->image_header }}"></p>
			<p>{!! $article->content !!}</p>
			<div class="ui divider"></div>
			{{ $article->detail_info }}
		</div>
	</div>
@endsection

<?php /** @var \App\Model\Web\Article $article */ ?>