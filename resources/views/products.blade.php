@extends('layouts.main')

@section('container')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Products</h1>
<div class="p-0 d-flex flex-wrap justify-content-center">
    @foreach ($products as $product)
    <div class="card m-3" style="width: 18rem;">
        <img style = "height: 100%" src="{{ $product['product_image'] ?  '/storage/' . $product['product_image'] : '/OIP.jpg' }}" class="card-img-top" alt="...">
        <div class="card-body text-center">
            <h5 class="card-title">{{$product['product_name']  }}</h5>
            <div class="badge bg-info text-wrap" style="width: 6rem;">
                {{ $product['category']['name'] }}
              </div>
            <p class="fw-normal mt-1">Rp. {{number_format($product['product_price'], 0,',', '.')}}</p>
            <p class="fw-normal">Stock: {{ $product['product_quantity'] }}</p>
            @can('admin')
            <a href="/admin/{{ $product['id'] }}/edit" class="btn btn-primary">Edit</a>
            
            <form action="/admin/{{ $product['id'] }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button type = "submit" class="btn btn-danger">Delete</button>
            </form>
            @else
            <form action="/cart" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                <button type = "submit" class="btn btn-primary">Add to cart</button>
            </form>
            @endcan
        </div>
    </div>
    @endforeach
  </div>
@endsection