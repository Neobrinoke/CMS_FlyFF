@extends('base')

@section('title', trans('title.password_reset'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="field {{ $errors->has('email') ? 'error'  : '' }}">
                    <div class="ui labeled input">
                        <label for="email" class="ui primary label"><i class="envelope icon"></i></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="@lang('password_reset.email')">
                    </div>
                </div>
                <div class="field">
                    <button class="ui right floated primary button" type="submit">@lang('password_reset.submit_request')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
