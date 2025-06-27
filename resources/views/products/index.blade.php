@extends('layouts.app')

@section('content')

    <div class="mb-3">
        @if(!auth()->check())

        <h2>Login As</h2>

        <div>
            @foreach($users as $user)
                <a href="{{route('login-as', $user->id)}}" type="button" class="btn btn-secondary">{{$user->name}}</a>
            @endforeach
        </div>
        @endif

        @if(auth()->check())

        <h2>Logged in as {{auth()->user()->name}}</h2>

        <div>
            <a href="{{route('logout')}}" type="button" class="btn btn-secondary">Logout</a>
        </div>
        @endif
    </div>

    <h1>Shop</h1>

    <div class="row g-3">
        @foreach($products as $item)
        <div class="col-4">
            <div class="card">
                <img src="{{$item->image}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p class="card-text">{{$item->description}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Ціна: {{$item->price}} грн</li>
                </ul>
                <div class="card-body">
                    <form action="{{ route('cart.add', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Додати до кошику</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
