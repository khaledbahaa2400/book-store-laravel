@extends('layout.app')

@section('title')
    Admin | users
@endsection

@section('body')
    <section class="add-products">
        <h1 class="title"> user accounts </h1>
        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            <h3>add user</h3>
            <div class="form-group">
                <input type="text" name="name" placeholder="Enter User Name" class="box" required>

                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Enter User Email" class="box" required>

                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Enter User Password" class="box" required>

                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Confirm User Password" class="box"
                    required>
            </div>

            <div class="form-group">
                <select name="type" class="box">
                    <option value="user">user</option>
                    @if (auth()->user()->type === 'super admin')
                        <option value="admin">admin</option>
                        <option value="super-admin">super admin</option>
                    @endif
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Add User" class="btn">
            </div>
        </form>
    </section>

    <section class="users">
        <div class="box-container">
            @forelse ($users as $user)
                <div class="box">
                    <p> username : <span>{{ $user->name }}</span> </p>
                    <p> email : <span>{{ $user->email }}</span> </p>
                    <p> user type : <span
                            style="color:{{ $user->type !== 'user' ? 'var(--orange)' : '' }}">{{ $user->type }}</span>
                    </p>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('delete this user?');" class="delete-btn">delete user</button>
                    </form>
                </div>
            @empty
                <p class="empty">No Users to Display</p>
            @endforelse
        </div>
    </section>
@endsection
