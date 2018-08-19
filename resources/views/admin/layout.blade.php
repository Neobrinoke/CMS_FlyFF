@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ mix('css/back.css') }}">
@endsection

@section('layout')
    <header class="ui menu">
        <div class="item header">
            <img src="{{ asset('images/header_logo.png') }}" alt=""><span>CMS FlyFF</span>
        </div>
        <div class="right item">
            <div class="ui action input">
                <input type="text" placeholder="Navigate to...">
                <div class="ui button">Go</div>
            </div>
        </div>
    </header>
    <section class="container">
        <nav class="ui vertical menu">
            <a class="item activable" href="{{ route('admin.home') }}">@lang('admin/nav.home')</a>
            <div class="item">
                Boutique
                <div class="menu">
                    <a class="item activable left icon"><i class="plus icon"></i>Ajouter</a>
                    <a class="item activable left icon"><i class="list icon"></i>Parcourir</a>
                </div>
            </div>
            <a class="item"><i class="grid layout icon"></i> Browse</a>
            <a class="item activable">Messages</a>
        </nav>
        <main>
            <h1>
                @yield('header')
            </h1>
            <div class="ui divider"></div>
            <article>
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
            </article>
            <section>
                @yield('content')
            </section>
        </main>
    </section>
@endsection
