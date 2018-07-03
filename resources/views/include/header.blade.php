<nav class="ui menu stackable">
    <div class="ui container">
        <a href="{{ route('home') }}" class="header item"><img class="logo" src="http://simg.gpotato.eu/common/icon/flyff.png"></a>
        <a href="{{ route('article.index') }}" class="item"><i class="newspaper outline icon"></i>@lang('trans/nav.news')</a>
        <div class="ui dropdown item">
            <i class="sort amount up icon"></i>@lang('trans/nav.ranking.header')
            <div class="menu">
                <a href="{{ route('ranking.player') }}" class="item">@lang('trans/nav.ranking.players')</a>
                <a href="{{ route('ranking.guild') }}" class="item">@lang('trans/nav.ranking.guilds')</a>
            </div>
        </div>
        <a href="{{ route('download.index') }}" class="item"><i class="download icon"></i>@lang('trans/nav.download')</a>
        <a href="{{ route('shop.index') }}" class="item"><i class="shopping cart icon"></i>@lang('trans/nav.shop')</a>
        <div class="right menu">
            @auth
                <a href="{{ route('shop.cart') }}" class="item">@lang('trans/nav.cart', ['number' => count(session('cart.items') ?? [])])</a>
                <div class="ui dropdown icon item">
                    <span><i class="user circle icon"></i>{{ auth()->user()->name }}</span>
                    <div class="menu">
                        <div class="item">My account</div>
                        <div class="divider"></div>
                        <a href="{{ route('password.request') }}" class="item">@lang('trans/nav.support')</a>
                        <div class="divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item">
                            <i class="sign out icon"></i>@lang('trans/home.aside.my_account.logout')
                        </a>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="item">@lang('trans/nav.login')</a>
                <a href="{{ route('register') }}" class="item">@lang('trans/nav.register')</a>
            @endauth
        </div>
    </div>
</nav>
<header class="ui container">
    <section class="logo">
        <img src="http://eu-uimg-wgp.webzen.com/788253779/Banner/07072014_111943_flyff-logo-new_407839.png" alt="logo">
    </section>
</header>