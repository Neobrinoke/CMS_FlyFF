@extends('base')

@section('title', __('site.title.register'))

@section('content')
	<form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('login') }}" method="POST">
		@csrf
		<div class="field">
			<div class="two fields">
				<div class="field {{ $errors->has('email') ? 'error'  : '' }}">
					<div class="ui labeled input">
						<label for="email" class="ui label"><i class="envelope icon"></i></label>
						<input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="@lang('site.login.email')">
					</div>
				</div>
				<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
					<div class="ui labeled input">
						<label for="password" class="ui label"><i class="key icon"></i></label>
						<input type="password" id="password" name="password" placeholder="@lang('site.login.password')">
					</div>
				</div>
			</div>
		</div>
		<div class="field">
			<a href="{{ route('password.request') }}" class="ui left floated red basic button">@lang('site.login.password_lost')</a>
			<button class="ui right floated primary button" type="submit">@lang('site.login.submit')</button>
		</div>
	</form>
@endsection