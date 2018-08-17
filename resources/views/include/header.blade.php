<nav class="ui menu stackable">
    <div class="ui container">
        <a href="{{ route('home') }}" class="header item"><img class="logo" src="{{ asset('images/nav_logo.png') }}"></a>
        <a href="{{ route('article.index') }}" class="item activable"><i class="newspaper outline icon"></i>@lang('nav.news')</a>
        <div class="ui dropdown item">
            <i class="sort amount up icon"></i>@lang('nav.ranking.header')
            <div class="menu">
                <a href="{{ route('ranking.player') }}" class="item">@lang('nav.ranking.players')</a>
                <a href="{{ route('ranking.guild') }}" class="item">@lang('nav.ranking.guilds')</a>
            </div>
        </div>
        <a href="{{ route('download.index') }}" class="item activable"><i class="download icon"></i>@lang('nav.download')</a>
        <a href="{{ route('shop.index') }}" class="item activable"><i class="shopping cart icon"></i>@lang('nav.shop')</a>
        <div class="right menu">
            @auth
                <a href="{{ route('shop.cart') }}" class="item activable">
                    <i class="shopping basket icon"></i>@lang('nav.cart')<span class="ui blue circular label">{{ count(session('cart.items') ?? []) }}</span>
                </a>
                <a href="{{ route('ticket.index') }}" class="item activable">
                    <i class="ticket icon"></i>@lang('nav.ticket')<span class="ui green circular label">{{ $loggedUser->tickets->count() }}</span>
                </a>
                <div class="ui dropdown icon item">
                    <img class="ui avatar image" src="{{ $loggedUser->avatar_image }}"><span>{{ $loggedUser->name }}</span>
                    <div class="menu">
                        <a href="{{ route('settings.general.index') }}" class="item"><i class="cog icon"></i>@lang('nav.player_settings')</a>
                        <div class="divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item">
                            <i class="sign out icon"></i>@lang('aside.my_account.logout')
                        </a>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="item activable">@lang('nav.login')</a>
                <a href="{{ route('register') }}" class="item activable">@lang('nav.register')</a>
            @endauth
        </div>
    </div>
</nav>
<header class="ui container">
    <section class="logo">
        <img src="{{ asset('images/header_logo.png') }}" alt="logo">
    </section>
</header>

<?php /** @var \App\Model\Web\User $loggedUser */ ?>