@extends('layouts.main')
{{-- @dd($product) --}}
{{-- @dd($product) --}}
@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit product</div>

                    <div class="card-body">
                        <form method="POST" action = "/admin/ {{ $product->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                              <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name = "name" value = "{{ $product->product_name }}">
                                <div id="nameError" class="form-text">
                                  @error('name')
                                      {{ $message }}
                                  @enderror
                                </div>
                              </div>

                              <div class = "mb-3">
                                <label for = "category" class = "form-label">Category</label>
                                <select class = "form-select" id = "category" name = "category" >
                                    @foreach($categories as $category)
                                        @if($category->id == $product->category_id)
                                            <option value = "{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value = "{{ $category->id }}">{{ $category->name }}</option>    
                                        @endif
                                    @endforeach
                                </select>
                                <div id="categoryError" class="form-text">
                                  @error('category')
                                      {{ $message }}
                                  @enderror
                                </div>
                              </div>

                              <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name = "price" value = {{ $product['product_price'] }} min = "0">
                                <div id="priceError" class="form-text">
                                  @error('price')
                                      {{ $message }}
                                  @enderror
                                </div>
                              </div>

                            <div class="mb-3">
                                @if($product['product_image'])
                                    <img src="{{ '/storage/' . $product['product_image'] }}" class="img-thumbnail d-block mb-2" style = "width: 300px; height: 200px">
                                @endif
                                <label for="product_image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="product_image" name = "product_image" >
                                <div id="imageError" class="form-text">
                                  @error('product_image')
                                      {{ $message }}
                                  @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name = "quantity" value = {{ $product['product_quantity'] }} min = "0">
                                <div id="quantityError" class="form-text">
                                  @error('quantity')
                                      {{ $message }}
                                  @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
