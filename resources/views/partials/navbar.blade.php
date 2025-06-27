<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('shop')}}">Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                Кошик

               @if($totalQuantity)
                   ({{ $totalQuantity }})
               @endif

            </a>
        </div>
    </div>
</nav>
