@extends('layout.app')

@section('title')
    About
@endsection

@section('body')
    <div class="heading">
        <h3>about us</h3>
        <p> <a href="{{ route('user.home') }}">home</a> / about </p>
    </div>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet voluptatibus aut hic molestias,
                    reiciendis natus fuga, cumque excepturi veniam ratione iure. Excepturi fugiat placeat iusto facere id
                    officia assumenda temporibus?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia
                    corporis ratione saepe sed adipisci?</p>
                <a href="{{ route('user.messages.create') }}" class="btn">contact us</a>
            </div>
        </div>
    </section>

    <section class="reviews">
        <h1 class="title">client's reviews</h1>

        <div class="box-container">
            @for ($i = 1; $i < 7; $i++)
                <div class="box">
                    <img src="images/pic-{{ $i }}.png" alt="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus
                        quia. Ducimus repudiandae dolore placeat.</p>
                    <div class="stars">
                        @for ($j = 0; $j < 4; $j++)
                            <i class='fas fa-star'></i>
                        @endfor

                        @if (true)
                            <i class='fas fa-star-half-alt'></i>
                        @endif
                    </div>
                    <h3>john deo</h3>
                </div>
            @endfor
        </div>
    </section>

    <section class="authors">
        <h1 class="title">greate authors</h1>

        <div class="box-container">
            @for ($i = 1; $i < 7; $i++)
                <div class="box">
                    <img src="images/author-{{ $i }}.jpg" alt="">
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                    <h3>john deo</h3>
                </div>
            @endfor
        </div>
    </section>
@endsection
