<nav class="ui menu stackable">
    <div class="ui container">
        <a href="{{ route('home') }}" class="header item"><img class="logo" src="http://simg.gpotato.eu/common/icon/flyff.png"></a>
        <a href="{{ route('article.index') }}" class="item activable"><i class="newspaper outline icon"></i>@lang('trans/nav.news')</a>
        <div class="ui dropdown item">
            <i class="sort amount up icon"></i>@lang('trans/nav.ranking.header')
            <div class="menu">
                <a href="{{ route('ranking.player') }}" class="item">@lang('trans/nav.ranking.players')</a>
                <a href="{{ route('ranking.guild') }}" class="item">@lang('trans/nav.ranking.guilds')</a>
            </div>
        </div>
        <a href="{{ route('download.index') }}" class="item activable"><i class="download icon"></i>@lang('trans/nav.download')</a>
        <a href="{{ route('shop.index') }}" class="item activable"><i class="shopping cart icon"></i>@lang('trans/nav.shop')</a>
        <div class="right menu">
            @auth
                <a href="{{ route('shop.cart') }}" class="item activable">
                    <i class="shopping basket icon"></i>@lang('trans/nav.cart')<span class="ui blue circular label">{{ count(session('cart.items') ?? []) }}</span>
                </a>
                <a href="{{ route('ticket.index') }}" class="item activable">
                    <i class="ticket icon"></i>@lang('trans/nav.ticket')<span class="ui green circular label">{{ $loggedUser->tickets->count() }}</span>
                </a>
                <div class="ui dropdown icon item">
                    <img class="ui avatar image" src="{{ $loggedUser->avatar_image }}"><span>{{ $loggedUser->name }}</span>
                    <div class="menu">
                        <a href="{{ route('settings.general.index') }}" class="item"><i class="cog icon"></i>@lang('trans/nav.player_settings')</a>
                        <div class="divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item">
                            <i class="sign out icon"></i>@lang('trans/aside.my_account.logout')
                        </a>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="item activable">@lang('trans/nav.login')</a>
                <a href="{{ route('register') }}" class="item activable">@lang('trans/nav.register')</a>
            @endauth
        </div>
    </div>
</nav>
<header class="ui container">
    <section class="logo">
        <img src="http://eu-uimg-wgp.webzen.com/788253779/Banner/07072014_111943_flyff-logo-new_407839.png" alt="logo">
    </section>
</header>

<?php /** @var \App\Model\Web\User $loggedUser */ ?>