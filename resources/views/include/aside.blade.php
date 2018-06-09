<aside>
	<div class="box">
		<div class="ui attached message">
			<h1 class="header">Connexion</h1>
		</div>
		<div class="ui attached fluid segment">
			@auth
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item"><i class="sign out icon"></i>Déconnexion</a>
			@else
				<form class="ui form {{ $errors->any() ? 'error' : '' }}" action="{{ route('login') }}" method="POST">
					@include('messages.error')
					@csrf
					<div class="field {{ $errors->has('email') ? 'error'  : '' }}">
						<div class="ui labeled input">
							<label for="email" class="ui label"><i class="envelope icon"></i></label>
							<input type="email" id="email" name="email" placeholder="Adresse email">
						</div>
					</div>
					<div class="field {{ $errors->has('password') ? 'error'  : '' }}">
						<div class="ui labeled input">
							<label for="password" class="ui label"><i class="key icon"></i></label>
							<input type="password" id="password" name="password" placeholder="Mot de passe">
						</div>
					</div>
					<div class="field">
						<button class="ui fluid brown button" type="submit">Connexion</button>
					</div>
					<div class="field">
						<a href="{{ route('register') }}" class="ui fluid blue button">S'inscrire</a>
					</div>
					<a href="{{ route('password.request') }}" class="ui mini negative fluid basic button">Mot de passe oublié ?</a>
				</form>
			@endauth
		</div>
	</div>
</aside>