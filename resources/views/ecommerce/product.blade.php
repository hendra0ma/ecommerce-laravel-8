@extends('layouts.ecommerce')

@section('title')
<title>Jual Produk Fashion - DW Ecommerce</title>
@endsection

@section('content')

<!--================Category Product Area =================-->
<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h3>Kategori Produk</h3>
                <ul class="list">
                    @foreach ($categories as $category)
                    <li>
                        <strong>

                            <ul class="list-group">
                                <li class="list-group-item"> <a href="{{ url('/category/' . $category->slug) }}">{{ $category->name }}</a></li>

                            </ul>
                        </strong>
                        @foreach ($category->child as $child)
                        <ul class="list" style="display: block">
                            <li>
                                <a href="{{ url('/category/' . $child->slug) }}">{{ $child->name }}</a>
                            </li>
                        </ul>
                        @endforeach
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-4">


                        @foreach ($products as $row)
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $row->name }}</h4>
                            </div>
                            <div class="card-body">
                                <img class="card-img-top" src="{{ asset('product/' . $row->image) }}" alt="{{ $row->name }}">
                                <p>
                                    {!!$row->description!!}
                                </p>
                                <h5>Rp {{ number_format($row->price) }}</h5>
                                <a href="{{ url('/product/' . $row->slug) }}" class="btn btn-primary">detail</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{ $products->links() }}
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->
@endsection