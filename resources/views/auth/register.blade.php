@extends('base')

@section('title', __('site.title.register'))

@section('content')
	<form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('register') }}" method="POST">
		@csrf
		<div class="field">
			<div class="two fields">
				<div class="field {{ $errors->has('name') ? 'error'  : '' }}">
					<label for="name">@lang('site.register.name')</label>
					<input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe">
				</div>
				<div class="field {{ $errors->has('email') ? 'error'  : '' }}">
					<label for="email">@lang('site.register.email')</label>
					<input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="john01@doe.fr">
				</div>
			</div>
		</div>
		<div class="field">
			<div class="two fields">
				<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
					<label for="password">@lang('site.register.password')</label>
					<input type="password" id="password" name="password" placeholder="*****">
				</div>
				<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
					<label for="password_confirmation">@lang('site.register.password_confirmation')</label>
					<input type="password" id="password_confirmation" name="password_confirmation" placeholder="*****">
				</div>
			</div>
		</div>
		<div class="field {{ $errors->has('rules') ? 'error'  : '' }}">
			<div class="ui segment">
				<div class="ui toggle checkbox">
					<input type="checkbox" id="rules" name="rules" tabindex="0" value="{{ old('rules') }}" class="hidden">
					<label for="rules">@lang('site.register.rules', ['url' => '#'])</label>
				</div>
			</div>
		</div>
		<div class="field">
			<button class="ui right floated brown button" type="submit">@lang('site.register.submit')</button>
		</div>
	</form>
@endsection
