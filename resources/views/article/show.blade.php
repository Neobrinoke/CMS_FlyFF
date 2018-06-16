@extends('base')

@section('title', __('site.title.article', ['title' => $article->title]))

@section('content')
	<div class="box">
		<div class="ui primary attached message">
			<h1 class="header">@yield('title')</h1>
		</div>
		<section class="ui attached fluid clearing segment">
			@if($article->image_header)
				<p><img class="ui centered image" src="{{ $article->image_header }}"></p>
			@endif
			<p>{!! $article->content !!}</p>
			<div class="ui divider"></div>
			<span>{{ $article->detail_info }}</span>
			@if($article->authorized_comment)
				<span class="ui right floated teal label"><i class="comment outline icon"></i>{{ $article->comment_count }}</span>
			@endif
		</section>

		@if($article->authorized_comment)
			<section class="ui fluid clearing segment">
				<h3 class="ui dividing header">@lang('site.article.comment.read')</h3>
				@include('article.include.comments', ['comments' => $article->comments, 'parentId' => null])
			</section>
			@auth
				<section class="ui fluid clearing segment">
					<h3 class="ui dividing header">@lang('site.article.comment.post')</h3>
					<form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('article.comment.store', [$article]) }}" method="POST">
						@csrf
						<div class="required field {{ $errors->has('content') ? 'error'  : '' }}">
							<label for="content">@lang('site.article.comment.comment')</label>
							<textarea name="content" id="content" cols="30" rows="5" maxlength="250">{{ old('content') }}</textarea>
						</div>
						<button class="ui right floated primary button" type="submit">@lang('site.article.comment.submit')</button>
					</form>
				</section>
			@endauth
		@endif
	</div>
@endsection

<?php /** @var \App\Model\Web\Article $article */ ?>
<?php /** @var \App\Model\Web\ArticleComment $comment */ ?>