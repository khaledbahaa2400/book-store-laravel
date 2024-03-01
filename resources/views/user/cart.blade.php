@extends('layout.app')

@section('title')
    User | Cart
@endsection

@section('body')
    <div class="heading">
        <h3>shopping cart</h3>
        <p> <a href="{{ route('user.home') }}">home</a> / cart </p>
    </div>

    <section class="shopping-cart">
        <h1 class="title">products added</h1>
        <div class="box-container">
            @forelse ($cartItems as $cartItem)
                <div class="box">
                    <form action="{{ route('user.cart-items.destroy', $cartItem->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('delete this from cart?');" class="fas fa-times"></button>
                    </form>

                    <img src="{{ url('storage/' . $cartItem->product->image) }}" alt="">
                    <div class="name">{{ $cartItem->product->name }}</div>
                    <div class="price">${{ $cartItem->product->price }}/-</div>

                    <form action="{{ route('user.cart-items.update', $cartItem->id) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="number" name="quantity" min="1" value="{{ $cartItem->quantity }}">
                        <input type="submit" value="update" class="option-btn">
                    </form>

                    <div class="sub-total"> sub total :
                        <span>${{ $cartItem->product->price * $cartItem->quantity }}/-</span>
                    </div>
                </div>
            @empty
                <p class="empty">your cart is empty</p>
            @endforelse
        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <form action="{{ route('user.cart-items.destroy-all') }}" method="POST">
                @csrf
                <button onclick="return confirm('delete all from cart?');"
                    class="delete-btn {{ $totalPrice < 1 ? 'disabled' : '' }}">delete all</button>
            </form>
        </div>

        <div class="cart-total">
            <p>grand total : <span>${{ $totalPrice }}/-</span></p>
            <div class="flex">
                <a href="{{ route('user.products.index') }}" class="option-btn">continue shopping</a>
                <a href="{{ route('user.orders.create') }}" class="btn {{ $totalPrice < 1 ? 'disabled' : '' }}">
                    proceed to checkout</a>
            </div>
        </div>
    </section>
@endsection
