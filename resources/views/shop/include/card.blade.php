<div class="card">
	<div class="content">
		<img class="ui mini left floated image" src="{{ $download->image }}">
		<div class="right aligned meta">
			<span>@lang('site.download.size')</span>
			<span>{{ $download->size }}</span>
		</div>
		@if(!$download->has_updated)
			<div class="right aligned meta">
				<span>@lang('site.download.created_at')</span>
				<span>{{ $download->created_ago }}</span>
			</div>
		@else
			<div class="right aligned meta">
				<span>@lang('site.download.updated_at')</span>
				<span>{{ $download->updated_ago }}</span>
			</div>
		@endif
	</div>
	<a class="ui compact bottom attached green labeled icon button" href="{{ $download->link }}" target="_blank"><i class="download icon"></i>@lang('site.download.action')</a>
</div>

<?php /** @var \App\Model\Web\Download $download */ ?>