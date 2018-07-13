@extends('base')

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="address card icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <div class="ui stackable grid">
                <div class="five wide column">
                    <div class="ui vertical menu">
                        <a href="{{ route('account.general') }}" class="item active">@lang('trans/account.general_info')</a>
                        <a class="item">
                            Spam
                            <div class="ui label">51</div>
                        </a>
                        <a class="item">
                            Updates
                            <div class="ui label">1</div>
                        </a>
                    </div>
                </div>
                <div class="eleven wide column">
                    @yield('account_content')
                </div>
            </div>
        </div>
    </div>
@endsection