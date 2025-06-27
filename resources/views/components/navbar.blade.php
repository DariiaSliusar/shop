<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('shop')}}">Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(!auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Login As
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($users as $user)
                            <li><a class="dropdown-item" href="{{route('login-as', $user->id)}}">{{$user->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endif
                @if(auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                Кошик

                @if($totalQuantity)
                    ({{ $totalQuantity }})
                @endif

            </a>
        </div>
    </div>
</nav>
