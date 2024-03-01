@extends('layout.app')

@section('title')
    Admin Panel
@endsection

@section('body')
    <section class="dashboard">
        <h1 class="title">dashboard</h1>

        <div class="box-container">
            <div class="box">
                <h3>${{ $total_pendings }}/-</h3>
                <p>total pendings</p>
            </div>

            <div class="box">
                <h3>${{ $total_completed }}/-</h3>
                <p>completed payments</p>
            </div>

            <div class="box">
                <h3>{{ $orders_count }}</h3>
                <p>order placed</p>
            </div>

            <div class="box">
                <h3>{{ $products_count }}</h3>
                <p>products added</p>
            </div>

            <div class="box">
                <h3>{{ $users_count }}</h3>
                <p>normal users</p>
            </div>

            <div class="box">
                <h3>{{ $admins_count }}</h3>
                <p>admin users</p>
            </div>

            <div class="box">
                <h3>{{ $supers_count }}</h3>
                <p>super admins</p>
            </div>

            <div class="box">
                <h3>{{ $messages_count }}</h3>
                <p>new messages</p>
            </div>
        </div>
    </section>
@endsection
