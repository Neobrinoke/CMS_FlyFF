<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

		<link href="{{ asset('css/semantic.css') }}" rel="stylesheet">
		<link href="{{ asset('css/swiper.css') }}" rel="stylesheet">
		<link href="{{ asset('css/main.css') }}" rel="stylesheet">
		@yield('css')
	</head>
	<body>
		@include('include.header')
		<main class="ui container">
			@include('include.aside')
			<section class="content">
				@if (session('status'))
					@component('message.success')
						{{ session('status') }}
					@endcomponent
				@endif
				@if (session('success'))
					@component('message.success')
						{{ session('success') }}
					@endcomponent
				@endif
				@if($errors->any())
					@include('message.errors')
				@endif
				@if (session('error'))
					@component('message.error')
						{{ session('error') }}
					@endcomponent
				@endif
				@yield('content')
			</section>
		</main>
		@include('include.footer')

		<script src="{{ asset('js/jquery.js') }}"></script>
		<script src="{{ asset('js/semantic.js') }}"></script>
		<script src="{{ asset('js/swiper.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>
		@yield('js')
	</body>
</html>
