@extends('admin.layout')

@section('title', trans('admin/title.home'))

@section('header')
    <i class="dashboard icon"></i> - <span>@yield('title')</span>
    <div class="ui breadcrumb right floated">
        <span>@yield('title')</span>
    </div>
@endsection

@section('content')
    <p>Home content</p>
@endsection