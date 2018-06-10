@extends('base')

@section('title', __('site.title.password_reset'))

@section('content')
	<form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('password.request') }}" method="POST">
		@csrf
		<input type="hidden" name="token" value="{{ $token }}">
		<div class="field {{ $errors->has('email') ? 'error'  : '' }}">
			<div class="ui labeled input">
				<label for="email" class="ui label"><i class="envelope icon"></i></label>
				<input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="@lang('site.password_reset.email')">
			</div>
		</div>
		<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
			<div class="ui labeled input">
				<label for="password" class="ui label"><i class="envelope icon"></i></label>
				<input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="@lang('site.password_reset.password')">
			</div>
		</div>
		<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
			<div class="ui labeled input">
				<label for="password_confirmation" class="ui label"><i class="envelope icon"></i></label>
				<input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="@lang('site.password_reset.password_confirmation')">
			</div>
		</div>
		<div class="field">
			<button class="ui right floated primary button" type="submit">@lang('site.password_reset.submit_reset')</button>
		</div>
	</form>
@endsection
