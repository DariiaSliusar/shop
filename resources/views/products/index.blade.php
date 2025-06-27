@extends('layouts.app')

@section('content')
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
