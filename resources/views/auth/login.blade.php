@extends('layout.app')

@section('title', 'Login')

@section('body')
    <div class="form-container">
        <form action="{{ route('login') }}" method="post">
            @csrf

            <h3>Sign In</h3>
            <div class="form-group">
                <input name="email" type="email" placeholder="Enter Your Email" class="box" required>

                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input name="password" type="password" placeholder="Enter Your Password" class="box" required>

                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" value="Sign In" class="btn">
            </div>

            <p>doesn't have an account? <a href="{{ route('register') }}">register now</a></p>
        </form>
    </div>
@endsection
