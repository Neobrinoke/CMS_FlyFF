@extends('base')

@section('title', __('trans/title.register'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="field">
                    <div class="two fields">
                        <div class="field {{ $errors->has('email') ? 'error'  : '' }}">
                            <div class="ui labeled input">
                                <label for="email" class="ui primary label"><i class="envelope icon"></i></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="@lang('trans/login.email')">
                            </div>
                        </div>
                        <div class="field {{ $errors->has('password') ? 'error'  : '' }}">
                            <div class="ui labeled input">
                                <label for="password" class="ui primary label"><i class="key icon"></i></label>
                                <input type="password" id="password" name="password" placeholder="@lang('trans/login.password')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <a href="{{ route('password.request') }}" class="ui left floated red basic button">@lang('trans/login.password_lost')</a>
                    <button class="ui right floated primary button" type="submit">@lang('trans/login.submit')</button>
                </div>
            </form>
        </div>
    </div>
@endsection