@extends('layouts.ecommerce')

@section('title')
<title>Keranjang Belanja - Dw Ecommerce</title>
@endsection

@section('content')
<!--================Home Banner Area =================-->
<section class="mt-3 ">

	<div class="container  card-body">
		<h2 class='text-center'>Pesanan Diterima</h2>


		<h3 class="alert alert-dark">Terima kasih, pesanan anda telah kami terima.</h3>
		<div class="row order_d_inner">
			<div class="col-lg-6">
				<div class="details_item">
					<h4>Informasi Pesanan</h4>
					<table class="table">
						<tr>
							<td>
								<span>Invoice</span>
							</td>
							<td>

								{{ $order->invoice }}
							</td>
						</tr>



						<tr>

							<td><span>Invoice</span> </td>
							<td>
								{{ $order->invoice }}
							</td>
						</tr>

						<tr>

							<td><span>Tanggal</span> </td>
							<td>
								{{ $order->created_at }}
							</td>
						</tr>

						<tr>

							<td><span>Subtotal</span> </td>
							<td>
								Rp {{ number_format($order->subtotal) }}
							</td>

						</tr>

					</table>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="details_item">
					<h4>Informasi Pemesan</h4>
					<table class="table">

						<tr>
							<td>

								<span>Alamat</span>
							</td>
							<td>

								{{ $order->customer_address }}
							</td>
						</tr>

						<tr>
							<td>

								<span>Kota</span>
							</td>
							<td>

								{{ $order->district->city->name }}
							</td>
						</tr>
						<tr>
							<td>

								<span>Country</span>
							</td>
							<td>
								Indonesia
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection