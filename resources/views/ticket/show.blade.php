@extends('base')

@section('title', trans('title.ticket_show', ['title' => $ticket->title]))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="ticket icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <div class="ui grid">
                <div class="eleven wide column">
                    <div class="ui comments">
                        <div class="comment">
                            <a class="avatar">
                                <img src="{{ $ticket->author->avatar_image }}">
                            </a>
                            <div class="content">
                                <a class="author">{{ $ticket->author->name }}</a>
                                <div class="metadata">
                                    <div class="date"><time datetime="{{ $ticket->created_at }}">{{ $ticket->created_at }}</time></div>
                                </div>
                                <div class="text">{!! nl2br($ticket->content) !!}</div>
                                @if($ticket->has_attachments)
                                    <div class="ui list">
                                        @foreach($ticket->attachments as $attachment)
                                            @if($attachment->file_exists)
                                                <div class="item">
                                                    <div class="content">
                                                        <a href="{{ $attachment->download_url }}" class="header" target="_blank"><i class="download icon"></i>{{ $attachment->name }}</a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="ui divider"></div>
                        </div>
                        @foreach($ticket->responses as $response)
                            <div class="comment">
                                <a class="avatar">
                                    <img src="{{ $response->author->avatar_image }}">
                                </a>
                                <div class="content">
                                    <a class="author">{{ $response->author->name }}</a>
                                    <div class="metadata">
                                        <div class="date"><time datetime="{{ $response->created_at }}">{{ $response->created_at }}</time></div>
                                    </div>
                                    <div class="text">{!! nl2br($response->content) !!}</div>
                                    @if($response->has_attachments)
                                        <div class="ui divider"></div>
                                        <div class="ui list">
                                            @foreach($response->attachments as $attachment)
                                                @if($attachment->file_exists)
                                                    <div class="item">
                                                        <div class="content">
                                                            <a href="{{ $attachment->download_url }}" class="header" target="_blank"><i class="download icon"></i>{{ $attachment->name }}</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="ui divider"></div>
                            </div>
                        @endforeach
                        @if($ticket->is_open)
                            <form class="ui form" action="{{ route('ticket.response.store', [$ticket]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="field">
                                    <label for="content">@lang('ticket.show.response.form.content')</label>
                                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                                </div>
                                <div class="field">
                                    <label for="attachments">@lang('ticket.show.response.form.attachments')</label>
                                    <input type="file" name="attachments[]" id="attachments" multiple>
                                </div>
                                <div class="field">
                                    <button class="ui primary right floated button" type="submit">@lang('ticket.show.response.form.submit')</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="five wide column">
                    <div class="ui message">
                        <p>
                            <strong>@lang('ticket.show.info_block.created_ago')</strong> <time datetime="{{ $ticket->created_at }}">{{ $ticket->created_at }}</time>
                        </p>
                        <p>
                            <strong>@lang('ticket.show.info_block.category')</strong> {{ $ticket->category->name }}
                        </p>
                        <p>
                            <strong>@lang('ticket.show.info_block.status')</strong> {{ $ticket->status_label }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Web\Ticket $ticket */ ?>
<?php /** @var \App\Model\Web\TicketResponse $response */ ?>
<?php /** @var \App\Model\Web\TicketAttachment $attachment */ ?>
