@extends('layout.app')

@section('title')
    User | Orders
@endsection

@section('body')
    <div class="heading">
        <h3>your orders</h3>
        <p> <a href="{{ route('user.home') }}">home</a> / orders </p>
    </div>

    <section class="placed-orders">
        <h1 class="title">placed orders</h1>
        <div class="box-container">
            @forelse ($orders as $order)
                <div class="box">
                    <p> placed on : <span>{{ $order->created_at }}</span> </p>
                    <p> name : <span>{{ $order->user->name }}</span> </p>
                    <p> email : <span>{{ $order->user->email }}</span> </p>
                    <p> number : <span>{{ $order->phone }}</span> </p>
                    <p> address : <span>{{ $order->address }}</span> </p>
                    <p> payment method : <span>{{ $order->payment_method }}</span> </p>
                    <p> your orders : <span>{{ $order->total_products }}</span> </p>
                    <p> total price : <span>${{ $order->total_price }}/-</span> </p>
                    <p> payment status : <span style="color:{{ $order->payment_status === 'pending' ? 'red' : 'green' }}">
                            {{ $order->payment_status }}</span>
                    </p>
                </div>
            @empty
                <p class="empty">no orders placed yet!</p>
            @endforelse
        </div>
    </section>
@endsection
