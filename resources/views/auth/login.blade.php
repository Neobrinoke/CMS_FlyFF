<div class="box">
	<div class="ui attached message">
		<h1 class="header">{{ __('site.title.connect') }}</h1>
	</div>
	<div class="ui attached fluid segment">
		<form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('login') }}" method="POST">
			@include('messages.error')
			@csrf
			<div class="field {{ $errors->has('email') ? 'error'  : '' }}">
				<div class="ui labeled input">
					<label for="email" class="ui label"><i class="envelope icon"></i></label>
					<input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('site.home.aside.login.email') }}">
				</div>
			</div>
			<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
				<div class="ui labeled input">
					<label for="password" class="ui label"><i class="key icon"></i></label>
					<input type="password" id="password" name="password" placeholder="{{ __('site.home.aside.login.password') }}">
				</div>
			</div>
			<div class="field">
				<button class="ui fluid brown button" type="submit">{{ __('site.home.aside.login.connect') }}</button>
			</div>
			<div class="field">
				<a href="{{ route('register') }}" class="ui fluid blue button">{{ __('site.home.aside.login.register') }}</a>
			</div>
			<a href="{{ route('password.request') }}" class="ui mini negative fluid basic button">{{ __('site.home.aside.login.password_lost') }}</a>
		</form>
	</div>
</div>