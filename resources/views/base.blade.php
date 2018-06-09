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
		@include('include.header')
		<main class="ui container">
			@include('include.aside')
			<section class="content">
				<div class="box">
					<div class="ui attached message">
						<h1 class="header">@yield('title')</h1>
					</div>
					<div class="ui attached fluid clearing segment">
						@if($errors->any())
							@include('messages.error')
						@endif
						@if (session('status'))
							@include('messages.success')
						@endif
						@yield('content')
					</div>
				</div>
			</section>
		</main>
		@include('include.footer')

		<script src="{{ asset('js/jquery.js') }}"></script>
		<script src="{{ asset('js/semantic.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>
		@yield('js')
	</body>
</html>
