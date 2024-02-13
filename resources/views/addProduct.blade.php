@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Add Product') }}</div>

                    <div class="card-body">
                        <form method="POST" action = "/admin" enctype="multipart/form-data">
                            @csrf
                              <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name = "name">
                                <div id="nameError" class="form-text">
                                  @error('name')
                                      {{ $message }}
                                  @enderror
                                </div>
                              </div>

                              <div class = "mb-3">
                                <label for = "category" class = "form-label">Category</label>
                                <select class = "form-select" id = "category" name = "category">
                                    @foreach($categories as $category)
                                        <option value = "{{ $category->id }}">{{ $category->name }}</option>
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
                                <input type="number" class="form-control" id="price" name = "price" min = "0">
                                <div id="priceError" class="form-text">
                                  @error('price')
                                      {{ $message }}
                                  @enderror
                                </div>
                              </div>

                            <div class="mb-3">
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
                                <input type="number" class="form-control" id="quantity" name = "quantity" min = "0">
                                <div id="quantityError" class="form-text">
                                  @error('quantity')
                                      {{ $message }}
                                  @enderror
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                              
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
