<div class="card">
    <div class="content">
        <img class="ui mini left floated image" src="{{ $download->image }}">
        <div class="right aligned meta">
            <span>@lang('trans/download.size')</span>
            <span>{{ $download->size }}</span>
        </div>
        @if(!$download->is_updated)
            <div class="right aligned meta">
                <span>@lang('trans/download.created_at')</span>
                <span>{{ $download->created_at->diffForHumans() }}</span>
            </div>
        @else
            <div class="right aligned meta">
                <span>@lang('trans/download.updated_at')</span>
                <span>{{ $download->updated_at->diffForHumans() }}</span>
            </div>
        @endif
    </div>
    <a class="ui compact bottom attached green labeled icon button" href="{{ $download->link }}" target="_blank"><i class="download icon"></i>@lang('trans/download.action')</a>
</div>

<?php /** @var \App\Model\Web\Download $download */ ?>