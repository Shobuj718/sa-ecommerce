@extends('frontend.layouts.master')

@section('main')

	<div class="container">
		
		<br>
		<h3 class="text-center">Login</h3>
		<hr>

		<form action="{{ route('register') }}" method="post" class="form">
			
			@csrf

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" class="form-control" required="">
			</div>


			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" required="">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-block btn-success">
					Login
				</button>
			</div>

		</form>

	</div>

@endsection