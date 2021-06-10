<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
	@yield('title')
	<link rel="stylesheet" href="{{ asset('ecommerce/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('ecommerce/css/font-awesome.min.css') }}">
	<style>
		.menu-sidebar-area {
			list-style-type: none;
			padding-left: 0;
			font-size: 15pt;
		}

		.menu-sidebar-area>li {
			margin: 0 0 10px 0;
			list-style-position: inside;
			border-bottom: 1px solid black;
		}

		.menu-sidebar-area>li>a {
			color: black
		}
	</style>
	@yield('css')
</head>

<body>
	<!--================Header Menu Area =================-->
	<header>


		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="#">Penjualan Mobil</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="{{route('front.index')}}">Home </a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('front.product')}}">produk</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Member
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								@if (auth()->guard('customer')->check())
								<a class="dropdown-item" href="{{ route('customer.logout') }}">logout</a>
								@else
								<a class="dropdown-item" href="{{ route('customer.login') }}">login</a>
								<a class="dropdown-item" href="{{ url('register	') }}">register</a>
								@endif
								<a class="dropdown-item" href="{{ route('customer.dashboard') }}">Akun Saya</a>

							</div>
						</li>
						<li class="nav-item float-right">
							<a class="btn btn-light" href="{{url('cart')}}">
								<i class="fa fa-shopping-cart"></i> Cart
							</a>
						</li>

					</ul>
				</div>
			</div>
		</nav>
	</header>

	</header>
	<!--================Header Menu Area =================-->

	@yield('content')

	<!--================ Subscription Area ================-->


	<div class="row footer-bottom d-flex justify-content-between align-items-center">
		<p class="col-lg-12 footer-text text-center">
			Copyright &copy;<script>
				document.write(new Date().getFullYear());
			</script>
			All rights reserved | This template is made with
			<i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">No made</a>
		</p>
	</div>
	</div>
	</footer>
	<!--================ End footer Area  =================-->

	<script src="{{ asset('ecommerce/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/popper.js') }}"></script>
	<script src="{{ asset('ecommerce/js/bootstrap.min.js') }}"></script>

	<script src="{{ asset('ecommerce/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('ecommerce/js/jquery.ajaxchimp.min.js') }}"></script>

	<script>
		$('#ui-view').ajaxLoad();
		$(document).ajaxComplete(function() {
			Pace.restart()
		});
	</script>
	<script>
		$(document).ready(function() {
			loadCity($('#province_id').val(), 'bySelect').then(() => {
				loadDistrict($('#city_id').val(), 'bySelect');
			})
		})

		$('#province_id').on('change', function() {
			loadCity($(this).val(), '');
		})

		$('#city_id').on('change', function() {
			loadDistrict($(this).val(), '')
		})

		function loadCity(province_id, type) {
			return new Promise((resolve, reject) => {
				$.ajax({
					url: "{{ url('/api/city') }}",
					type: "GET",
					data: {
						province_id: province_id
					},
					success: function(html) {
						$('#city_id').empty()
						$('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
						$.each(html.data, function(key, item) {


							$('#city_id').append('<option value="' + item.id + '">' + item.name + '</option>')
							resolve()
						})
					}
				});
			})
		}

		function loadDistrict(city_id, type) {
			$.ajax({
				url: "{{ url('/api/district') }}",
				type: "GET",
				data: {
					city_id: city_id
				},
				success: function(html) {
					$('#district_id').empty()
					$('#district_id').append('<option value="">Pilih Kecamatan</option>')
					$.each(html.data, function(key, item) {


						$('#district_id').append('<option value="' + item.id + '">' + item.name + '</option>')
					})
				}
			});
		}
	</script>

	@yield('js')
</body>

</html>