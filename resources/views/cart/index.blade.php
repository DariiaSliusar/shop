@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Shopping Cart</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($cartItems->isNotEmpty())
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Назва</th>
                            <th>Ціна</th>
                            <th>Кількість</th>
                            <th>Сума</th>
                            <th>Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $id => $details)
                            <tr>
                                <td>{{ $details->product->name }}</td>
                                <td>{{ $details->product->price }} грн</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="me-2">
                                            @csrf
                                            @method('PATCH')
                                            <div class="input-group" style="width: 120px">
                                                <button type="button" class="btn btn-outline-secondary" onclick="decrementQuantity(this)">-</button>
                                                <input type="number"
                                                       name="quantity"
                                                       value="{{ $details->quantity}}"
                                                       min="1"
                                                       class="form-control text-center"
                                                       onchange="this.form.submit()">
                                                <input type="hidden" name="cartItemId" value="{{ $details->id }}">
                                                <button type="button" class="btn btn-outline-secondary" onclick="incrementQuantity(this)">+</button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $details->price }} грн</td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="cartItemId" value="{{ $details->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені?')">
                                            <i class="fas fa-trash"></i> Видалити
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Загальна сума:</strong></td>
                            <td colspan="2"><strong>{{ $totalPrice }} грн</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                Ваш кошик порожній
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        function incrementQuantity(button) {
            const input = button.parentElement.querySelector('input');
            input.value = parseInt(input.value) + 1;
            input.form.submit();
        }

        function decrementQuantity(button) {
            const input = button.parentElement.querySelector('input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                input.form.submit();
            }
        }
    </script>
    @endpush
@endsection
