@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ mix('assets/css/back.css') }}">
@endsection

@section('layout')
    <header class="ui menu">
        <div class="item header">
            <img src="{{ asset('assets/images/header_logo.png') }}" alt=""><span>{{ config('app.name') }}</span>
        </div>
        @yield('nav-buttons')
        <div class="right menu">
            <div class="ui top right pointing dropdown icon item">
                <span class="text"><i class="{{ $currentLocale['flag'] }} flag"></i>{{ $currentLocale['native'] }}</span>
                <div class="menu">
                    <div class="ui icon search input">
                        <i class="search icon"></i>
                        <input type="text" placeholder="@lang('footer.lang.search')">
                    </div>
                    <div class="scrolling menu">
                        @foreach($locales as $localeCode => $properties)
                            <a class="item" data-value="important" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <i class="{{ $properties['flag'] }} flag"></i>{{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="ui top right pointing dropdown icon item">
                <img class="ui avatar image" src="{{ $loggedUser->avatar_image }}"><span>{{ $loggedUser->name }}</span>
                <div class="menu">
                    <a href="{{ route('home') }}" class="item"><i class="home icon"></i>@lang('admin/nav.back_to_site')</a>
                    <a href="{{ route('settings.general.index') }}" class="item"><i class="cog icon"></i>@lang('nav.player_settings')</a>
                    <div class="divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item">
                        <i class="sign out icon"></i>@lang('nav.logout')
                    </a>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
    </header>
    <section class="container">
        <nav class="ui vertical menu">
            <a class="item activable" href="{{ route('admin.home') }}"><i class="dashboard icon"></i>@lang('admin/nav.home')</a>
            <div class="item">
                <i class="shop icon"></i>@lang('admin/nav.shop.title')
                <div class="menu">
                    <a class="item activable left icon" href="{{ route('admin.shop.index') }}"><i class="list icon"></i>@lang('admin/nav.shop.browse')</a>
                    <a class="item activable left icon" href="{{ route('admin.shop.create') }}"><i class="plus icon"></i>@lang('admin/nav.shop.add')</a>
                </div>
            </div>
            <a class="item"><i class="grid layout icon"></i> Browse</a>
            <a class="item activable">Messages</a>
        </nav>
        <main>
            <h1>
                @yield('header')
            </h1>
            <div class="ui divider"></div>
            <article>
                @if(session('status'))
                    @component('message.success')
                        {{ session('status') }}
                    @endcomponent
                @endif
                @if(session('success'))
                    @component('message.success')
                        {{ session('success') }}
                    @endcomponent
                @endif
                @if($errors->any())
                    @include('message.errors', ['errors' => $errors->all()])
                @endif
                @if(session('error'))
                    @component('message.error')
                        {{ session('error') }}
                    @endcomponent
                @endif
            </article>
            <section>
                @yield('content')
            </section>
        </main>
    </section>
@endsection
