@extends('base')

@section('title', trans('trans/title.register'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <div class="two fields">
                        <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                            <label for="name">@lang('trans/register.name')</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe">
                        </div>
                        <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                            <label for="email">@lang('trans/register.email')</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="john01@doe.fr">
                        </div>
                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                            <label for="password">@lang('trans/register.password')</label>
                            <input type="password" id="password" name="password" placeholder="*****">
                        </div>
                        <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                            <label for="password_confirmation">@lang('trans/register.password_confirmation')</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="*****">
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label for="profile_img">@lang('trans/register.profile_img')</label>
                    <input type="file" name="profile_img" id="profile_img">
                </div>
                <div class="field {{ $errors->has('rules') ? 'error' : '' }}">
                    <div class="ui segment">
                        <div class="ui toggle checkbox">
                            <input type="checkbox" id="rules" name="rules" value="1">
                            <label for="rules">@lang('trans/register.rules', ['url' => '#'])</label>
                            <?php //@todo mettre ici le bon lien des rules ?>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <button class="ui right floated primary button" type="submit">@lang('trans/register.submit')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
