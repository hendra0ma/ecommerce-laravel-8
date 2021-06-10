@extends('layouts.ecommerce')

@section('title')
<title>DW Ecommerce - Pusat Belanja Online</title>
@endsection

@section('content')
<section class="mt-2">
	<div class="md-2">
		<div class="container">
			<div class="row">
				<h2>List Mobil</h2>
			</div>
			<div class="row">
				@forelse($products as $row)
				<div class="col-md-4">

					<div class="card" style="width: 18rem;">
						<img src="{{ asset('product/' . $row->image) }}" class="card-img-top" alt="...">
						<div class="card-body">
							<h3 class="card-title">{{ $row->name }}</h3>
							<h5>Rp {{ number_format($row->price) }}</h5>
							<p class="card-text">{!!$row->description!!}</p>
							<a href="{{ url('/product/' . $row->slug) }}" class="btn btn-primary">Detail</a>
						</div>
					</div>
				</div>
				@empty

				@endforelse
			</div>
		</div>

		<div class="row">
			{{ $products->links() }}
		</div>
	</div>
	</div>
</section>
<!--================End Feature Product Area =================-->
@endsection