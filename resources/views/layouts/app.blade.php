<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<link href="{{ asset('css/semantic.css') }}" rel="stylesheet">
		<link href="{{ asset('css/main.css') }}" rel="stylesheet">

		<script src="{{ asset('js/semantic.js') }}" defer></script>
	</head>
	<body>
		<header>
			<div class="ui container">HEADER</div>
		</header>
		<main class="ui container">
			<nav class="ui inverted menu">
				<a href="#" class="header item">
					<img class="logo" src="assets/images/logo.png">
					Project Name
				</a>
				<a href="#" class="item">Home</a>
			</nav>
			
		</main>
		<footer>
			<div class="ui container">FOOTER</div>
		</footer>
	</body>
</html>
