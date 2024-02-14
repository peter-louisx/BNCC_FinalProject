@extends('layouts.main')

@section('container')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(sizeof($productChanged) > 0)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <ul>
        @foreach($productChanged as $msg)
        <li>{{ $msg }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@foreach($carts as $product)
<div class = "row m-2 border border-3 rounded p-2">
    <div class = "col d-flex align-items-center">
        <img  src="{{ $product['product']['product_image']?  '/storage/' . $product['product']['product_image'] : '/OIP.jpg' }}" class = "img-fluid">
    </div>

    <div class = "col d-flex justify-content-center align-items-center text-center">
        <div class = "product_info">
            <div class = "row"> 
                <h2>{{ $product['product']['product_name'] }}</h2>
            </div>
            <div class = "row">
                <div class="badge m-auto bg-info text-wrap" style="width: 6rem;">
                {{ $product['product']['category']['name'] }}
                </div>
            </div>
        </div>
        
    </div>
    
    <div class = "col d-flex justify-content-center align-items-center">
        <form class="text-center" action="/cart/{{ $product['id'] }}" method="POST">
            @csrf
            @method('PUT')
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $product['quantity'] }}" min="0" max="{{ $product['product']['product_quantity'] }}">
            <button class = "btn btn-primary mt-2">Update</button>
        </form>
    </div>

    <div class = "col d-flex justify-content-center align-items-center">
        <div class = "row text-center">
            <div class="row">
                <h2>Total Price</h2>
                <h2>Rp. {{ number_format($product['product']['product_price'] * $product['quantity'], 0,',', '.') }}</h2>
            </div>
            
            <div class = "row">
                <form action="/cart/{{ $product['id'] }}" method="POST">
                    @csrf
                    @method("delete")
                    <input type="hidden" name="cart_id" value="{{ $product['id'] }}">
                    <button class = "btn btn-danger">Delete</button>
                </form>
            </div>
        </div> 
    </div>
</div>
@endforeach

@if(count($carts) == 0)
    <h1 class="m-2">Cart is empty</h1>
@else
<div class = "p-2">
    <form action="/cart/checkout" method="POST">
        @csrf
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name = "address" value = "{{ old("address") }}">
            <div id="addressError" class="form-text">
              @error('address')
                  {{ $message }}
              @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="post_code" class="form-label">Post Code</label>
            <input type="text" class="form-control" id="post_code" name = "post_code" value = "{{ old("post_code") }}">
            <div id="postCodeError" class="form-text">
              @error('post_code')
                  {{ $message }}
              @enderror
            </div>
        </div>

        <h1 class="mb-3">Total Price: Rp. {{ number_format($totalPrice, 0,',', '.') }}</h1>

        <button class = "btn btn-primary">Checkout</button>
    </form>
</div>
@endif
@endsection