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
				<span class="ui right floated teal label"><i class="comment outline icon"></i>{{ $article->comments->count() }}</span>
			@endif
		</section>

		@if($article->authorized_comment)
			<section class="ui fluid clearing segment">
				<div class="ui comments">
					<h3 class="ui dividing header">@lang('site.article.comment.read')</h3>
					@foreach($article->comments as $comment)
						<div class="comment">
							<a class="avatar" href="#"><img src="https://semantic-ui.com/images/avatar/small/matt.jpg"></a>
							<div class="content">
								<a class="author" href="#">{{ $comment->author->name }}</a>
								<div class="metadata">
									<span class="date">{{ $comment->created_at }}</span>
								</div>
								<div class="text">{{ $comment->content }}</div>
								@auth
									<div class="actions">
										<a data-modal="#reply_{{ $comment->id }}"><i class="reply icon"></i>@lang('site.comment.reply')</a>
										@if($comment->is_mine)
											<a data-modal="#edit_{{ $comment->id }}"><i class="edit icon"></i>@lang('site.comment.edit')</a>
											<a data-modal="#comment_{{ $comment->id }}_destroy"><i class="trash icon"></i>@lang('site.comment.delete')</a>
										@endif
									</div>
								@endauth
							</div>
						</div>
					@endforeach
				</div>
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

	@foreach($article->comments as $comment)
		@auth
			<div class="ui modal" id="reply_{{ $comment->id }}">
				<div class="header">reply_{{ $comment->id }}</div>
				<div class="image content">
					<div class="description">
						<div class="ui header">We've auto-chosen a profile image for you.</div>
						<p>We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</p>
						<p>Is it okay to use this photo?</p>
					</div>
				</div>
				<div class="actions">
					<div class="ui black deny button">Nope</div>
					<div class="ui positive right labeled icon button">Yep, that's me<i class="checkmark icon"></i></div>
				</div>
			</div>
			@if($comment->is_mine)
				<div class="ui modal" id="edit_{{ $comment->id }}">
					<div class="header">edit_{{ $comment->id }}</div>
					<div class="content">
						<p class="center aligned">Voulez-vous vraiment supprimer ce commentaire ?</p>
						<p class="center aligned">Toute les réponses seront aussi supprimé.</p>
						<p class="center aligned">Cette action est irréversible et prend effet imédiatement après la confirmation.</p>
					</div>
					<div class="actions">
						<div class="ui black deny button">Nope</div>
						<div class="ui positive right labeled icon button">Yep, that's me<i class="checkmark icon"></i></div>
					</div>
				</div>
				<div class="ui modal" id="comment_{{ $comment->id }}_destroy">
					<div class="header">Suppression de commentaire</div>
					<div class="content">
						@foreach(trans('site.comment.delete_confirm.messages') as $message)
							<p>{{ $message }}</p>
						@endforeach
					</div>
					<div class="actions">
						<div class="ui red cancel labeled icon button"><i class="remove icon"></i>@lang('site.comment.delete_confirm.no')</div>
						<div class="ui green ok right labeled icon button" data-submit="#comment_{{ $comment->id }}_destroy_form"><i class="checkmark icon"></i>@lang('site.comment.delete_confirm.yes')</div>
						<form action="{{ route('article.comment.destroy', [$article, $comment]) }}" method="POST" id="comment_{{ $comment->id }}_destroy_form" style="display: none;">@csrf</form>
					</div>
				</div>
			@endif
		@endauth
	@endforeach
@endsection

<?php /** @var \App\Model\Web\Article $article */ ?>
<?php /** @var \App\Model\Web\ArticleComment $comment */ ?>