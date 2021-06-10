@extends('layouts.ecommerce')

@section('title')
<title>Jual {{ $product->name }}</title>
@endsection

@section('content')
<!--================Home Banner Area =================-->
<section class="mt-3 text-center">

	<div class="container">

		<h2>{{ $product->name }}</h2>

	</div>
</section>
<!--================End Home Banner Area =================-->

<div class="product_image_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<img class="d-block img-thumbnail" src="{{ asset('product/' . $product->image) }}" alt="{{ $product->name }}">
			</div>
			<div class="col-lg-5 offset-lg-1">

				<h3>{{ $product->name }}</h3>
				<h2>Rp {{ number_format($product->price) }}</h2>
				<ul class="list">
					<li>

						<span>Kategori</span> : {{ $product->category->name }}</a>

				</ul>
				<p>
					@if (auth()->guard('customer')->check())
					<label>Afiliasi Link</label>
					<input type="text" value="{{ url('/product/ref/' . auth()->guard('customer')->user()->id . '/' . $product->id) }}" readonly class="form-control">
					@endif
				</p>
				<form action="{{ route('front.cart') }}" method="POST">
					@csrf
					<div class="product_count">
						<label for="qty">Quantity:</label>
						1
						<input type="hidden" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
						<input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">

					</div>
					<div class="card_area">
						<button class="btn btn-dark">Add to Cart</button>
					</div>

					@if (session('success'))
					<div class="alert alert-success mt-2">{{ session('success') }}</div>
					@endif
				</form>
				<br>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="color: black">
						{!! $product->description !!}
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
										<td>
											<h5>Berat</h5>
										</td>
										<td>
											<h5>{{ $product->weight }} kg</h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Harga</h5>
										</td>
										<td>
											<h5>Rp {{ number_format($product->price) }}</h5>
										</td>
									</tr>
									<tr>
										<td>
											<h5>Kategori</h5>
										</td>
										<td>
											<h5>{{ $product->category->name }}</h5>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->

<div class="container">

</div>

<!--================End Product Description Area =================-->
@endsection