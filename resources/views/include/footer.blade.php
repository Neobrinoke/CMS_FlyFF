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
                <h4 class="ui header">@lang('nav.ticket')</h4>
                <div class="ui bottom left pointing dropdown">
                    <input type="hidden" name="filters">
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