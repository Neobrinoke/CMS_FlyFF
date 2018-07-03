@extends('base')

@section('title', __('trans/title.download'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="download icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <h2 class="ui dividing header">@lang('trans/download.clients_links')</h2>
            <div class="ui three stackable cards">
                @foreach($clients as $download)
                    @include('download.include.card')
                @endforeach
            </div>
            <h2 class="ui dividing header">@lang('trans/download.patcher_links')</h2>
            <div class="ui three stackable cards">
                @foreach($patchers as $download)
                    @include('download.include.card')
                @endforeach
            </div>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Web\Download $download */ ?>