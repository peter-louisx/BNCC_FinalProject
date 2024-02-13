@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session()->has('loginError'))
    <div class="alert alert-danger" role="alert">
        {{ session('loginError') }}
    </div>
@endif
<h1>Login</h1>
<form action = {{ route("login-user") }} method = "POST">  
  @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="text" class="form-control" id="email" name = "email" value = "">
      <div id="emailError" class="form-text">
        @error('email')
            {{ $message }}
        @enderror
      </div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name = "password" value = "">
    </div>
    

    <button type="submit" class="btn btn-primary">Login</button>
  </form>
@endsection

