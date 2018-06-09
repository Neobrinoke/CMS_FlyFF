<aside>
	@auth
		<div class="box">
			<div class="ui attached message">
				<h1 class="header">{{ __('site.title.my_account') }}</h1>
			</div>
			<div class="ui attached fluid segment">
				<form id="logout-form" action="{{ route('logout') }}" method="POST">
					@csrf
					<button class="ui red fluid mini basic button" type="submit"><i class="sign out icon"></i>{{ __('site.home.aside.my_account.logout') }}</button>
				</form>
			</div>
		</div>
	@else
		@include('auth.login')
	@endif
</aside>