@extends('layout.app')

@section('title', 'Register')

@section('body')
    <div class="form-container">
        <form action="{{ route('register') }}" method="post">
            @csrf

            <h3>Register Now</h3>
            <div class="form-group">
                <input name="name" type="text" placeholder="Enter Your Name" class="box" required>

                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input name="email" type="email" placeholder="Enter Your Email" class="box" required>

                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input name="password" type="password" placeholder="Enter Your Password" required class="box">

                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input name="password_confirmation" type="password" placeholder="Confirm Your Password" required
                    class="box">
            </div>

            <div class="form-group">
                <button wire:click="register" class="btn">Register Now</button>
            </div>

            <p>already have an account? <a href="{{ route('login') }}">login now</a></p>
        </form>
    </div>
@endsection
