<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          @if (Auth::check())
          <li class="nav-item">
            <form action="{{route('logout')}}" method="post">
                @csrf
                @method('POST')
                <input class="nav-link" type="submit" value="Logout">
            </form>
          </li>
          @else
          <li class="nav-item">
            <a href="{{route('login')}}" class="nav-link">Login</a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{route('cart.index')}}" class="nav-link">
                <span class="text-secondary">|</span>
                <div class="btn-group">
                    <span class="btn btn-sm btn-info"><i class="fa fa-cart-shopping"></i></span>
                    <span class="btn btn-sm btn-info">
                        <span class="rounded-circle bg-danger text-light" style="height: 20px; width:20px; display: inline-block">{{Auth::check() ? $carts->sum('qty') : 0}}</span>
                    </span>
                </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
