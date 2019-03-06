@extends('frontend.layouts.master')

@section('main')

<div class="container">
	<br>
	<p class="text-center">{{ $product->title }}</p>
	<hr>

	<div class="card">
		<div class="row">
			<aside class="col-sm-5 border-right">
				<article class="gallery-wrap">
					<div>
						<img class="card-img-top" src="{{ asset($product->getFirstMediaUrl('products')) }}" alt="{{ $product->title }}">
					</div>
				</article>
			</aside>

			<aside class="col-sm-7">
				<article class="card-body p-5">
					<h3 class="title mb-3">{{ $product->title }}</h3>

					<p class="price-detail-wrap">
						<span class="price h3 text-warning">
							<span class="currency">BDT</span>
							<span class="mum">
							  @if($product->sale_price != null && $product->sale_price > 0)
		                        BDT <strike> {{ $product->sale_price }} </strike> BDT {{ $product->sale_price }}
		                      @else
		                        BDT {{ $product->price }}
		                      @endif
							</span>
						</span>
					</p>

					<dl class="item-property">
						<dt>Description</dt>
						<dd><p>{{ $product->descriptionn }}</p></dd>
					</dl>

					<hr>

					 <form action="{{ route('cart.add') }}" method="post">
                          @csrf
                          <input type="hidden" name="product_id" value="{{ $product->id }}">
                          <button type="submit" class="btn btn-lg btn-outline-secondary">
                          <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                      </form>

				</article>
			</aside>

		</div>
	</div>

</div>

@endsection