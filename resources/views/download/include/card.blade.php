<div class="card">
    <div class="content">
        <img class="ui mini left floated image" src="{{ $download->image }}">
        <div class="right aligned meta">
            <span>@lang('download.size')</span>
            <span>{{ $download->size }}</span>
        </div>
        @if(!$download->is_updated)
            <div class="right aligned meta">
                <span>@lang('download.created_at')</span>
                <time datetime="{{ $download->created_at }}">{{ $download->created_at }}</time>
            </div>
        @else
            <div class="right aligned meta">
                <span>@lang('download.updated_at')</span>
                <time datetime="{{ $download->updated_at }}">{{ $download->updated_at }}</time>
            </div>
        @endif
    </div>
    <a class="ui compact bottom attached green labeled icon button" href="{{ $download->link }}" target="_blank"><i class="download icon"></i>@lang('download.action')</a>
</div>

<?php /** @var \App\Model\Web\Download $download */ ?>