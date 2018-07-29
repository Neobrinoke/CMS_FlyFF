<div class="ui comments" @if(!is_null($parentId)) id="comment_{{ $parentId }}_responses" @endif>
    @foreach($comments as $comment)
        <div class="comment">
            <a class="avatar" href="#"><img src="{{ $comment->author->avatar_image }}"></a>
            <div class="content">
                <a class="author" href="#">{{ $comment->author->name }}</a>
                <div class="metadata">
                    <time datetime="{{ $comment->created_at }}">{{ $comment->created_at }}</time>
                </div>
                <div class="text">{{ $comment->content }}</div>
                @auth
                    <div class="actions">
                        <a data-show="#comment_{{ $comment->is_response ? $comment->parent->id : $comment->id }}_reply_section"><i class="reply icon"></i>@lang('trans/comment.reply')</a>
                        @if($comment->is_mine)
                            <a data-modal="#comment_{{ $comment->id }}_edit_modal"><i class="edit icon"></i>@lang('trans/comment.edit')</a>
                            <a data-modal="#comment_{{ $comment->id }}_destroy_modal"><i class="trash icon"></i>@lang('trans/comment.delete')</a>
                        @endif
                        @if($comment->has_responses)
                            <a data-toggle="#comment_{{ $comment->id }}_responses" data-hideMessage="<i class='eye icon'></i>@lang('trans/comment.hide')" data-showMessage="<i class='eye icon'></i>@lang('trans/comment.show')"><i class='eye icon'></i>@lang('trans/comment.hide')</a>
                        @endif
                    </div>
                @endauth
            </div>
            @if($comment->has_responses)
                @include('article.include.comments', ['comments' => $comment->responses, 'parentId' => $comment->id])
            @endif
            @auth
                @if(!$comment->is_response)
                    <section class="ui fluid clearing segment" id="comment_{{ $comment->id }}_reply_section" style="display: none; margin-left: 1em;">
                        <form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('article.comment.response.store', [$article, $comment]) }}" method="POST">
                            @csrf
                            <div class="required field {{ $errors->has('content') ? 'error'  : '' }}">
                                <label for="content">@lang('trans/article.comment.comment')</label>
                                <textarea name="content" id="content" cols="30" rows="2" maxlength="250">{{ old('content') }}</textarea>
                            </div>
                            <div class="ui red cancel labeled icon button" data-hide="#comment_{{ $comment->id }}_reply_section"><i class="remove icon"></i>@lang('trans/comment.edit_modal.cancel')</div>
                            <button class="ui primary right labeled icon button" type="submit"><i class="checkmark icon"></i>@lang('trans/article.comment.submit')</button>
                        </form>
                    </section>
                @endif
            @endauth
        </div>
    @endforeach
</div>

@foreach($comments as $comment)
    @auth
        @if($comment->is_mine)
            <div class="ui modal" id="comment_{{ $comment->id }}_edit_modal">
                <div class="header">@lang('trans/comment.edit_modal.header')</div>
                <div class="content">
                    <form class="ui form" action="{{ route('article.comment.update', [$article, $comment]) }}" method="POST" id="comment_{{ $comment->id }}_edit_form">
                        @csrf
                        <div class="required field">
                            <label for="content">@lang('trans/article.comment.comment')</label>
                            <textarea name="content" id="content" cols="30" rows="5" maxlength="250">{{ old('content') ?: $comment->content }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="actions">
                    <div class="ui red cancel labeled icon button"><i class="remove icon"></i>@lang('trans/comment.edit_modal.cancel')</div>
                    <div class="ui green ok right labeled icon button" data-submit="#comment_{{ $comment->id }}_edit_form"><i class="checkmark icon"></i>@lang('trans/comment.edit_modal.submit')</div>
                </div>
            </div>
            <div class="ui modal" id="comment_{{ $comment->id }}_destroy_modal">
                <div class="header">@lang('trans/comment.delete_modal.header')</div>
                <div class="content">
                    @foreach(trans('trans/comment.delete_modal.messages') as $message)
                        <p>{{ $message }}</p>
                    @endforeach
                </div>
                <div class="actions">
                    <div class="ui red cancel labeled icon button"><i class="remove icon"></i>@lang('trans/comment.delete_modal.no')</div>
                    <div class="ui green ok right labeled icon button" data-submit="#comment_{{ $comment->id }}_destroy_form"><i class="checkmark icon"></i>@lang('trans/comment.delete_modal.yes')</div>
                    <form action="{{ route('article.comment.destroy', [$article, $comment]) }}" method="POST" id="comment_{{ $comment->id }}_destroy_form" style="display: none;">@csrf</form>
                </div>
            </div>
        @endif
    @endauth
@endforeach

<?php /** @var \App\Model\Web\ArticleComment $comment */ ?>