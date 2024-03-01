@extends('layout.app')

@section('title')
    User | Search
@endsection

@section('body')
    <div class="heading">
        <h3>Search</h3>
        <p> <a href="{{ route('user.home') }}">home</a> / search </p>
    </div>

    <section class="search-form">
        <form action="" method="GET">
            <input type="text" name="keyword" placeholder="search products..." class="box">
            <input type="submit" value="search" class="btn">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">
        <div class="box-container">
            @if (request('keyword'))
                @forelse ($products as $product)
                    @include('user.includes.product-card')
                @empty
                    <p class="empty">no result found!</p>
                @endforelse
            @else
                <p class="empty">search something!</p>
            @endif
        </div>
    </section>
@endsection
