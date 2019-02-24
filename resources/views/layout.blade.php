@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ mix('css/front.css') }}">
@endsection

@section('layout')
    <nav class="ui menu stackable">
        <div class="ui container">
            <a href="{{ route('home') }}" class="header item"><img class="logo" src="{{ asset('images/nav_logo.png') }}"></a>
            <a href="{{ route('article.index') }}" class="item activable"><i class="newspaper outline icon"></i>@lang('nav.news')</a>
            <div class="ui top pointing dropdown item">
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
                    @if($loggedUser->hasVerifiedEmail())
                        <a href="{{ route('shop.cart') }}" class="item activable">
                            <i class="shopping basket icon"></i>@lang('nav.cart')<span class="ui blue circular label">{{ count(session('cart.items') ?? []) }}</span>
                        </a>
                        <a href="{{ route('ticket.index') }}" class="item activable">
                            <i class="ticket icon"></i>@lang('nav.ticket')<span class="ui green circular label">{{ $loggedUser->tickets->count() }}</span>
                        </a>
                    @endif
                    <div class="ui top right pointing dropdown icon item">
                        <img class="ui avatar image" src="{{ $loggedUser->avatar_image }}"><span>{{ $loggedUser->name }}</span>
                        <div class="menu">
                            @if($loggedUser->hasVerifiedEmail())
                                <a href="{{ route('admin.home') }}" class="item"><i class="cogs icon"></i>@lang('nav.back_office')</a>
                                <a href="{{ route('settings.general.index') }}" class="item"><i class="cog icon"></i>@lang('nav.player_settings')</a>
                                <div class="divider"></div>
                            @endif
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item">
                                <i class="sign out icon"></i>@lang('nav.logout')
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

    <main class="ui container">
        <aside>
            <div class="box">
                <div class="ui primary attached message">
                    <h1 class="header">@lang('title.server_info')</h1>
                </div>
                <div class="ui attached fluid segment">
                    <table class="ui very basic compact table">
                        <tbody>
                            <tr>
                                <td>@lang('aside.server_status.status')</td>
                                <td class="right aligned">{{ $serverStatus->status }}</td>
                            </tr>
                            <tr>
                                <td>@lang('aside.server_status.accounts_number')</td>
                                <td class="right aligned">{{ $serverStatus->accounts_number }}</td>
                            </tr>
                            <tr>
                                <td>@lang('aside.server_status.players_number')</td>
                                <td class="right aligned">{{ $serverStatus->players_number }}</td>
                            </tr>
                            <tr>
                                <td>@lang('aside.server_status.connected_number')</td>
                                <td class="right aligned">{{ $serverStatus->connected_number }}</td>
                            </tr>
                            <tr>
                                <td>@lang('aside.server_status.max_connected_number')</td>
                                <td class="right aligned">{{ $serverStatus->max_connected_number }}</td>
                            </tr>
                            <tr>
                                <td>@lang('aside.server_status.exp_rate')</td>
                                <td class="right aligned">{{ $serverStatus->exp_rate }}</td>
                            </tr>
                            <tr>
                                <td>@lang('aside.server_status.drop_rate')</td>
                                <td class="right aligned">{{ $serverStatus->drop_rate }}</td>
                            </tr>
                            <tr>
                                <td>@lang('aside.server_status.penyas_rate')</td>
                                <td class="right aligned">{{ $serverStatus->penyas_rate }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="ui primary attached message">
                    <h1 class="header">@lang('title.hall_of_fame')</h1>
                </div>
                <div class="ui attached fluid segment">
                    <div class="ui middle aligned list">
                        <div class="item">
                            <img class="ui image" src="{{ asset('images/MVP.png') }}" title="@lang('aside.hall_of_fame.mvp')">
                            <div class="middle aligned content">{{ $serverStatus->mvp_info }}</div>
                        </div>
                        <div class="item">
                            <img class="ui image" src="{{ asset('images/GS.png') }}" title="@lang('aside.hall_of_fame.gs')">
                            <div class="middle aligned content">{{ $serverStatus->gs_info }}</div>
                        </div>
                        <div class="item">
                            <img class="ui image" src="{{ asset('images/souv.png') }}" title="@lang('aside.hall_of_fame.souv')">
                            <div class="middle aligned content">{{ $serverStatus->lord_info }}</div>
                        </div>
                        <div class="item">
                            @if($serverStatus->event_info)
                                <img class="ui image popup_element" src="{{ asset('images/event.png') }}" title="@lang('aside.hall_of_fame.event')" data-html="{!! nl2br($serverStatus->event_info->details) !!}">
                                <div class="middle aligned content">{{ $serverStatus->event_info->message }}</div>
                            @else
                                <img class="ui image" src="{{ asset('images/event.png') }}" title="@lang('aside.hall_of_fame.event')">
                                <div class="middle aligned content">@lang('aside.hall_of_fame.no_event_currently')</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <section class="content">
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

            @yield('content')
        </section>
    </main>

    <footer class="ui vertical footer segment">
        <div class="ui center aligned container">
            <div class="ui stackable divided grid">
                <div class="three wide column">
                    <h4 class="ui header">@lang('nav.download')</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Client</a>
                        <a href="#" class="item">Patcher</a>
                    </div>
                </div>

                <div class="three wide column">
                    <h4 class="ui header">@lang('nav.shop')</h4>
                    <div class="ui link list">
                        <a href="#" class="item">Cash point</a>
                        <a href="#" class="item">Vote point</a>
                    </div>
                </div>

                <div class="three wide column">
                    <h4 class="ui header">@lang('footer.lang.title')</h4>
                    <div class="ui bottom left pointing dropdown">
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
                </div>

                <div class="seven wide column">
                    <h4 class="ui header">Footer Header</h4>
                    <p>Extra space for a call to action inside the footer that could help re-engage users.</p>
                </div>
            </div>

            <div class="ui section divider"></div>

            <img src="{{ asset('images/footer_logo.png') }}" class="ui centered mini image">
            <div class="ui horizontal small divided link list">
                <a class="item" href="#">Site Map</a>
                <a class="item" href="#">Contact Us</a>
                <a class="item" href="#">Terms and Conditions</a>
                <a class="item" href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>
@endsection

<?php /** @var \App\Model\Web\User $loggedUser */ ?>
<?php /** @var \App\Helper\ServerStatus $serverStatus */ ?>
