@extends('layout.app')

@section('title')
    User | Home
@endsection

@section('body')
    <section class="home">
        <div class="content">
            <h3>Hand Picked Book to your door.</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quod? Reiciendis ut porro iste totam.</p>
            <a href="{{ route('user.about') }}" class="white-btn">discover more</a>
        </div>
    </section>

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

        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="{{ route('user.products.index') }}" class="option-btn">load more</a>
        </div>
    </section>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>

            <div class="content">
                <h3>about us</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia
                    corporis ratione saepe sed adipisci?</p>
                <a href="{{ route('user.about') }}" class="btn">read more</a>
            </div>
        </div>
    </section>

    <section class="home-contact">
        <div class="content">
            <h3>have any questions?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam
                voluptatibus?</p>
            <a href="{{ route('user.messages.create') }}" class="white-btn">contact us</a>
        </div>
    </section>
@endsection
