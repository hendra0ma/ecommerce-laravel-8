@extends('layouts.ecommerce')

@section('title')
<title>Keranjang Belanja - Dw Ecommerce</title>
@endsection

@section('content')
<!--================Home Banner Area =================-->
<section class="text-center mt-3">
	<h2>Keranjang Belanja</h2>
	<div class="page_link">

	</div>
</section>
<!--================End Home Banner Area =================-->

<!--================Cart Area =================-->
<section class="cart_area">
	<div class="container">
		<div class="cart_inner">
			<form action="{{ route('front.update_cart') }}" method="post">
				@csrf
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Product</th>
								<th scope="col">Price</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($carts as $row)
							<tr>
								<td>
									<div class="media">
										<div class="d-flex">
											<img src="{{ asset('storage/products/' . $row['product_image']) }}" width="100px" height="100px" alt="{{ $row['product_name'] }}">
										</div>
										<div class="media-body">
											<p>{{ $row['product_name'] }}</p>
										</div>
									</div>
								</td>
								<td>
									<h5>Rp {{ number_format($row['product_price']) }}</h5>
								</td>
								<td>
									<div class="product_count">1
										<input type="hidden" name="qty[]" readonly id="sst{{ $row['product_id'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="input-text qty">
										<input type="hidden" name="product_id[]" value="{{ $row['product_id'] }}" class="form-control">

									</div>
								</td>
								<td>
									<h5>Rp {{ number_format($row['product_price'] * $row['qty']) }}</h5>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="4">Tidak ada belanjaan</td>
							</tr>
							@endforelse
							<tr class="">
								<td></td>
								<td></td>
								<td></td>
							</tr>
			</form>
			<tr>
				<td>

				</td>
				<td>

				</td>
				<td>
					<h5>Subtotal</h5>
				</td>
				<td>
					<h5>Rp {{ number_format($subtotal) }}</h5>
				</td>
			</tr>
			{{-- --}}
			<tr class="out_button_area">
				<td></td>
				<td></td>
				<td></td>
				<td>
					<div class="checkout_btn_inner">
						<a class="btn btn-dark" href="{{ route('front.product') }}">Continue Shopping</a>
						<a class="btn btn-primary" href="{{ route('front.checkout') }}">Proceed to checkout</a>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
	</div>
</section>
<!--================End Cart Area =================-->
@endsection