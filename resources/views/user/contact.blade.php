@extends('layout.app')

@section('title')
    User | contact
@endsection

@section('body')
    <div class="heading">
        <h3>contact us</h3>
        <p> <a href="{{ route('user.home') }}">home</a> / contact </p>
    </div>

    <section class="contact">
        <form action="{{ route('user.messages.store') }}" method="post">
            @csrf

            <h3>say something!</h3>
            <input readonly name="name" value="{{ auth()->user()->name }}" class="box">
            <input readonly name="email" value="{{ auth()->user()->email }}" class="box">

            <input name="number" placeholder="enter your number" class="box" required>
            @error('number')
                <span class="error">{{ $message }}</span>
            @enderror

            <textarea name="message" placeholder="enter your message" cols="30" rows="10" required class="box"></textarea>
            @error('message')
                <span class="error">{{ $message }}</span>
            @enderror

            <input type="submit" value="send message" class="btn">
        </form>

    </section>
@endsection
