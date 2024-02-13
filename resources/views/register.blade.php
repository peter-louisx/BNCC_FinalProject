@extends('layouts.main')
{{-- @if(old('name'))
    @dd(old('name'));
@endif --}}
@section('container')
<h1>Register</h1>
<form action = {{ route('add-user') }} method="POST">  
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name = "name" value = "{{ old("name") }}">
        <div id="nameError" class="form-text">
            @error('name')
                {{ $message }}
            @enderror
        </div>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="text" class="form-control" id="email" name = "email" value = {{ old("email") }}>
      <div id="emailError" class="form-text">
        @error('email')
            {{ $message }}
        @enderror
      </div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name = "password" value = {{ old("password") }}>
      <div id="passwordError" class="form-text">
        @error('password')
            {{ $message }}
        @enderror
      </div>
    </div>
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="password_confirmation" name = "password_confirmation" value = {{ old("password_confirmation") }}>
    </div>
    <div class="mb-3">
        <label for="phone_number" class="form-label">Nomor Telpon</label>
        <input type="text" class="form-control" id="phone_number" name = "phone_number" value = {{ old("phone_number") }}>
        <div id="phone_numberError" class="form-text">
            @error('phone_number')
                {{ $message }}
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
@endsection

