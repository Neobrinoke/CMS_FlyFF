<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

		<link href="{{ asset('css/semantic.css') }}" rel="stylesheet">
		<link href="{{ asset('css/main.css') }}" rel="stylesheet">
		@yield('css')
	</head>
	<body>
		<nav class="ui menu stackable">
			<div class="ui container">
				<a href="#" class="header item"><img class="logo" src="http://simg.gpotato.eu/common/icon/flyff.png"></a>
				<a href="#" class="item">Classement</a>
				<a href="#" class="item">Téléchargement</a>
				<a href="#" class="item">Support</a>
				<a href="#" class="item">Boutique</a>
			</div>
		</nav>
		<header class="ui container">
			<section class="logo">
				<img src="http://eu-uimg-wgp.webzen.com/788253779/Banner/07072014_111943_flyff-logo-new_407839.png" alt="logo">
			</section>
		</header>
		<main class="ui container">
			<aside>
				<div class="box">
					<div class="ui attached message">
						<h1 class="header">Connexion</h1>
					</div>
					<div class="ui attached fluid segment">
						<form class="ui form">
							<div class="field">
								<input type="text" placeholder="Adresse email">
							</div>
							<div class="field">
								<input type="password" placeholder="Mot de passe">
							</div>
							<button class="ui button" type="submit">Connexion</button>
						</form>
					</div>
				</div>
			</aside>
			<section class="content">
				@yield('content')
			</section>
		</main>
		<footer class="ui vertical footer segment">
			<div class="ui center aligned container">
				<div class="ui stackable divided grid">
					<div class="three wide column">
						<h4 class="ui header">Téléchargement</h4>
						<div class="ui link list">
							<a href="#" class="item">Client</a>
							<a href="#" class="item">Patcher</a>
						</div>
					</div>
					<div class="three wide column">
						<h4 class="ui header">Boutique</h4>
						<div class="ui link list">
							<a href="#" class="item">Cash point</a>
							<a href="#" class="item">Vote point</a>
						</div>
					</div>
					<div class="three wide column">
						<h4 class="ui header">Support</h4>
						<div class="ui link list">
							<a href="#" class="item">Liste</a>
							<a href="#" class="item">Créer</a>
						</div>
					</div>
					<div class="seven wide column">
						<h4 class="ui header">Footer Header</h4>
						<p>Extra space for a call to action inside the footer that could help re-engage users.</p>
					</div>
				</div>
				<div class="ui section divider"></div>
				<img src="http://simg.gpotato.eu/common/icon/flyff.png" class="ui centered mini image">
				<div class="ui horizontal small divided link list">
					<a class="item" href="#">Site Map</a>
					<a class="item" href="#">Contact Us</a>
					<a class="item" href="#">Terms and Conditions</a>
					<a class="item" href="#">Privacy Policy</a>
				</div>
			</div>
		</footer>

		<script src="{{ asset('js/jquery.js') }}"></script>
		<script src="{{ asset('js/semantic.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>
		@yield('js')
	</body>
</html>
