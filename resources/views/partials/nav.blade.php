<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">BNCC</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @auth
          @can('admin')
          <li class="nav-item">
            <a class="nav-link {{ Request::is("admin") ? "active" : ""}}" aria-current="page" href="/admin">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is("admin/create") ? "active" : ""}}" aria-current="page" href="/admin/create">Create Product</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link {{ Request::is("/") ? "active" : ""}}" aria-current="page" href="/">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is("cart") ? "active" : ""}}" aria-current="page" href="/cart">Cart</a>
          </li>
          @endcan
          <form action = {{ route("logout-user") }} method = "POST">  
            @csrf
            <button type="submit" class="nav-link">Logout</button>
          </form>
          @else
          <li class="nav-item">
            <a class="nav-link {{ Request::is("login") ? "active" : ""}}" aria-current="page" href="/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is("register") ? "active" : ""}}" aria-current="page" href="/register">Register</a>
          </li>
          @endauth
        </ul>
        @auth
        <a class="nav-link active" aria-current="page">Halo {{ auth()->user()->name }}</a>
        @endauth
      </div>
    </div>
  </nav>