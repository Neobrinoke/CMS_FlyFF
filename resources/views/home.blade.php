@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Dashboard</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif

						You are logged in!

						{{--@foreach(\App\Model\Character\Character::all() as $character)--}}
						{{--@php(var_dump($character->account))--}}
						{{--@endforeach--}}

						@foreach(\App\Model\Account\Account::all() as $account)
							@php(var_dump($account->account))
							@php(var_dump($account->characters))
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
