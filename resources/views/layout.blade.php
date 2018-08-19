@extends('base')

@section('css')
    <link rel="stylesheet" href="{{ mix('css/front.css') }}">
@endsection

@section('layout')
    @include('include.header')
    <main class="ui container">
        @include('include.aside')
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
    @include('include.footer')
@endsection
