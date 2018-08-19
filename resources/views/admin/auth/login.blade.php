@extends('base')

@section('title', trans('admin/login.title'))

@section('css')
    <style>
        body {
            background-color: #DADADA;
        }

        body > .grid {
            height: 100%;
        }

        .image {
            margin-top: -100px;
        }

        .column {
            max-width: 450px;
        }
    </style>
@endsection

@section('layout')
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui header">
                <span class="content">@lang('admin/login.title')</span>
            </h2>
            <form class="ui large form {{ $errors->any() ? 'error' : '' }}" action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="@lang('admin/login.email')">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" id="password" name="password" placeholder="@lang('login.password')">
                        </div>
                    </div>
                    <button class="ui fluid large primary submit button" type="submit">@lang('login.submit')</button>
                </div>
            </form>
        </div>
    </div>
@endsection