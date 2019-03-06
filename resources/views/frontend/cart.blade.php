@extends('frontend.layouts.master')

@section('main')

	<div class="container">
		<br>
		<h3 class="text-center">Cart</h3>
		<hr>

		@if(session()->has('cart'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
		@else

		@endif

		@if(empty($cart))
			<div class="alert alert-warning">
				Please add some product to your cart
			</div>
		@else
			<table class="table table-border">
			<thead>
				<tr>
					<td>Serial</td>
					<td>Product</td>
					<td>Unit_Price</td>
					<td>Quantity</td>
					<td>Total_Price</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				@php $i = 1 @endphp
				@foreach($cart as $key => $product)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $product['title'] }}</td>
					<td>BDT {{ number_format($product['unit_price'], 2) }}</td>
					<td><input type="number" name="quantity" value="{{ $product['quantity']  }}"></td>
					<td>BDT {{ number_format($product['total_price'], 2) }}</td>
					<td>

						<form action="{{ route('cart.remove') }}" method="post">
                          @csrf
                          <input type="hidden" name="product_id" value="{{ $key }}">
                          <button type="submit" class="btn btn-lg btn-outline-secondary">
                          <i class="fas fa-remove"></i> Remove
                          </button>
                      	</form>

					</td>
				</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Total</td>
					<td>BDT {{ number_format($cart['total'], 2) }}</td>
					<td></td>
				</tr>
			</tbody>
		</table>

		<a class="btn btn-danger" href="{{ route('cart.clear') }}">Cart Clear</a>
		<a class="btn btn-success" href="{{ route('checkout') }}">Checkout</a>
		
		@endif

		

	</div>

@endsection