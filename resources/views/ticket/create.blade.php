@extends('base')

@section('title', trans('trans/title.ticket'))

@section('content')
    <div class="box">
        <div class="ui primary attached message">
            <h1 class="header"><i class="ticket icon"></i>@yield('title')</h1>
        </div>
        <div class="ui attached fluid clearing segment">
            <form class="ui form" action="{{ route('ticket.store') }}" method="POST">
                @csrf
                <div class="two fields">
                    <div class="field">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title">
                    </div>
                    <div class="field">
                        <label for="category_id">Catégorie</label>
                        <select class="ui dropdown" name="category_id" id="category_id">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label for="content">Description de votre problème</label>
                    <textarea name="content" id="content"></textarea>
                </div>
                <div class="field">
                    <button class="ui primary right floated button" type="submit">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<?php /** @var \App\Model\Web\TicketCategory $category */ ?>