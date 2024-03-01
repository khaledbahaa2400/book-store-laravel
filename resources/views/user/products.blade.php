@extends('layout.app')

@section('title')
    User | Shop
@endsection

@section('body')
    <div class="heading">
        <h3>our shop</h3>
        <p> <a href="{{ route('user.home') }}">home</a> / shop </p>
    </div>

    <section class="products">
        <h1 class="title">latest products</h1>
        <div class="box-container">
            @forelse ($products as $product)
                @include('user.includes.product-card')
            @empty
                <p class="empty">no products added yet!</p>
            @endforelse

            @error('quantity')
                <script>
                    toastr.options.timeOut = 3000;
                    toastr.error("{{ $message }}")
                </script>
            @enderror
        </div>
    </section>
@endsection
