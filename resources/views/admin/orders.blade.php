@extends('layout.app')

@section('title')
    Admin | Orders
@endsection

@section('body')
    <section class="orders">
        <h1 class="title">placed orders</h1>

        <div class="box-container">
            @forelse ($orders as $order)
                <div class="box">
                    <p> name : <span>{{ $order->user->name }}</span> </p>
                    <p> email : <span>{{ $order->user->email }}</span> </p>
                    <p> number : <span>{{ $order->phone }}</span> </p>
                    <p> address : <span>{{ $order->address }}</span> </p>
                    <p> placed on : <span>{{ $order->created_at }}</span> </p>
                    <p> total products : <span>{{ $order->total_products }}</span> </p>
                    <p> total price : <span>${{ $order->total_price }}/-</span> </p>
                    <p> payment method : <span>{{ $order->payment_method }}</span> </p>

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                        @csrf
                        @method('put')
                        <select name="paymentStatus">
                            <option value="" selected disabled>{{ $order->payment_status }}</option>
                            <option value="pending">pending</option>
                            <option value="completed">completed</option>
                        </select>
                        <input type="submit" value="update" class="option-btn">
                    </form>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="delete" onclick="return confirm('delete this order?');"
                            class="delete-btn">
                    </form>
                </div>
            @empty
                <p class="empty">no orders placed yet!</p>
            @endforelse
        </div>
    </section>
@endsection
