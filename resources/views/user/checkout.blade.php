@extends('layout.app')

@section('title')
    Checkout
@endsection

@section('body')
    <div class="heading">
        <h3>shopping cart</h3>
        <p> <a href="{{ route('user.home') }}">home</a> / checkout </p>
    </div>

    <section class="display-order">
        @forelse ($cartItems as $cartItem)
            <p>{{ $cartItem->product->name }}<span>(${{ $cartItem->product->price }}/- x
                    {{ $cartItem->quantity }})</span>
            </p>
        @empty
            <p class="empty">your cart is empty</p>
            <div class="grand-total"> grand total : <span>${{ $totalPrice }}/-</span></div>

            <div class="flex">
                <a href="{{ route('user.products.index') }}" class="option-btn" style="margin: 2.5rem;">continue shopping</a>
            </div>
        @endforelse
    </section>

    @if ($totalPrice > 0)
        <section class="checkout">
            <div class="grand-total"> grand total : <span>${{ $totalPrice }}/-</span></div>
            <form action="{{ route('user.orders.store') }}" method="post">
                @csrf
                <h3>place your order</h3>

                <input type="hidden" name="cartItem" value="{{ json_encode($cartItems) }}">
                <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">

                <div class="flex">
                    <div class="inputBox">
                        <span>your number :</span>
                        <input type="text" name="number" placeholder="enter your number" required>

                        @error('number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="inputBox">
                        <span>payment method :</span>

                        <select name="method">
                            <option value="cash on delivery">cash on delivery</option>
                            <option value="credit card">credit card</option>
                            <option value="paypal">paypal</option>
                        </select>

                        @error('method')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="inputBox">
                        <span>address line 01 :</span>
                        <input type="number" name="building" placeholder="e.g. building no." min="1" required>

                        @error('building')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="inputBox">
                        <span>address line 02 :</span>
                        <input type="text" name="street" placeholder="e.g. street name" required>

                        @error('street')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="inputBox">
                        <span>city :</span>
                        <input type="text" name="city" placeholder="e.g. Dokki" required>

                        @error('city')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="inputBox">
                        <span>governorate :</span>
                        <input type="text" name="governorate" placeholder="e.g. Giza" required>

                        @error('governorate')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="inputBox">
                        <span>country :</span>
                        <input type="text" name="country" placeholder="e.g. Egypt" required>

                        @error('country')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="inputBox">
                        <span>postal code :</span>
                        <input type="number" name="postal" placeholder="e.g. 123456" min="0" required>

                        @error('postal')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <input type="submit" value="order now" class="btn">
            </form>
        </section>
    @endif
@endsection
