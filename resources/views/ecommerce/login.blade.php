@extends('layouts.ecommerce')

@section('title')
<title>Login</title>
@endsection

@section('content')
<section class="jumbotron ">
	<div class="container">
		<h2 class="text-center">Login Pages</h2>
		<div class="row">
			<div class="offset-md-3 col-lg-6">
				@if (session('success'))
				<div class="alert alert-success">{{ session('success') }}</div>
				@endif

				@if (session('error'))
				<div class="alert alert-danger">{{ session('error') }}</div>
				@endif

				<div class="card card-body">

					<form class="row login_form" action="{{ route('customer.post_login') }}" method="post" id="contactForm" novalidate="novalidate">
						@csrf
						<div class="col-md-12 form-group">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
						</div>
						<div class="col-md-12 form-group">
							<input type="password" class="form-control" id="password" name="password" placeholder="******">
						</div>

						<div class="col-md-12 form-group">
							<button type="submit" value="submit" class="btn btn-dark">Log In</button>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection