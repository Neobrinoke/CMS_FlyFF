@extends('base')

@section('title', __('site.title.password_reset'))

@section('content')
	<form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('password.email') }}" method="POST">
		@csrf
		<div class="field {{ $errors->has('email') ? 'error'  : '' }}">
			<div class="ui labeled input">
				<label for="email" class="ui label"><i class="envelope icon"></i></label>
				<input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="@lang('site.password_reset.email')">
			</div>
		</div>
		<div class="field">
			<button class="ui right floated primary button" type="submit">@lang('site.password_reset.submit_request')</button>
		</div>
	</form>
@endsection
