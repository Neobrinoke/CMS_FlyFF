@extends('base')

@section('title', __('site.title.register'))

@section('content')
	<div class="box">
		<div class="ui attached message">
			<h1 class="header">{{ __('site.title.register') }}</h1>
		</div>
		<div class="ui attached fluid segment">
			<form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('register') }}" method="POST">
				@include('messages.error')
				@csrf
				<div class="field">
					<div class="two fields">
						<div class="field {{ $errors->has('name') ? 'error'  : '' }}">
							<label for="name">{{ __('site.register.name') }}</label>
							<input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe">
						</div>
						<div class="field {{ $errors->has('email') ? 'error'  : '' }}">
							<label for="email">{{ __('site.register.email') }}</label>
							<input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="john01@doe.fr">
						</div>
					</div>
				</div>
				<div class="field">
					<div class="two fields">
						<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
							<label for="password">{{ __('site.register.password') }}</label>
							<input type="password" id="password" name="password" placeholder="*****">
						</div>
						<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
							<label for="password_confirmation">{{ __('site.register.password_confirmation') }}</label>
							<input type="password" id="password_confirmation" name="password_confirmation" placeholder="*****">
						</div>
					</div>
				</div>
					<div class="field {{ $errors->has('rules') ? 'error'  : '' }}">
						<div class="ui segment">
						<div class="ui toggle checkbox">
							<input type="checkbox" id="rules" name="rules" tabindex="0" value="{{ old('rules') }}" class="hidden">
							<label for="rules">{!! __('site.register.rules', ['url' => '#']) !!}</label>
						</div>
						</div>
					</div>
				<div class="field">
					<button class="ui brown button">{{ __('site.register.register') }}</button>
				</div>
			</form>
		</div>
	</div>
@endsection
