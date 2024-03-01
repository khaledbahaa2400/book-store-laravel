@if (session('error') || session('success'))
    @if (session('error'))
        <script>
            toastr.options.timeOut = 2000;
            toastr.error("{{ session('error') }}")
        </script>
    @else
        <script>
            toastr.options.timeOut = 2000;
            toastr.success("{{ session('success') }}")
        </script>
    @endif
    {{ session()->forget(['success', 'error']) }}
@endif

@auth
    <header class="header">
        <div class="flex">
            <a href="{{ Str::startsWith(Route::currentRouteName(), 'user') ? route('user.home') : route('admin.home') }}"
                class="logo">{{ Str::startsWith(Route::currentRouteName(), 'user') ? 'Bookly' : 'Admin Panel' }}</a>

            @if (Str::startsWith(Route::currentRouteName(), 'user'))
                <nav id="navbar" class="navbar">
                    <a href="{{ route('user.home') }}" class="{{ Route::is('user.home') ? 'disabled' : '' }}">home</a>
                    <a href="{{ route('user.about') }}" class="{{ Route::is('user.about') ? 'disabled' : '' }}">about</a>
                    <a href="{{ route('user.products.index') }}"
                        class="{{ Route::is('user.products.index') ? 'disabled' : '' }}">shop</a>
                    <a href="{{ route('user.messages.create') }}"
                        class="{{ Route::is('user.messages.create') ? 'disabled' : '' }}">contact</a>
                    <a href="{{ route('user.orders.index') }}"
                        class="{{ Route::is('user.orders.index') ? 'disabled' : '' }}">orders</a>
                </nav>
            @else
                <nav id="navbar" class="navbar">
                    <a href="{{ route('admin.home') }}" class="{{ Route::is('admin.home') ? 'disabled' : '' }}">home</a>
                    <a href="{{ route('admin.products.index') }}"
                        class="{{ Route::is('admin.products.index') ? 'disabled' : '' }}">products</a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="{{ Route::is('admin.orders.index') ? 'disabled' : '' }}">orders</a>
                    <a href="{{ route('admin.users.index') }}"
                        class="{{ Route::is('admin.users.index') ? 'disabled' : '' }}">users</a>
                    <a href="{{ route('admin.messages.index') }}"
                        class="{{ Route::is('admin.messages.index') ? 'disabled' : '' }}">messages</a>
                </nav>
            @endif

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                @if (Str::startsWith(Route::currentRouteName(), 'user'))
                    <a href="{{ route('user.search') }}" class="fas fa-search"></a>
                @endif
                <div id="user-btn" class="fas fa-user"></div>
                @if (Str::startsWith(Route::currentRouteName(), 'user'))
                    <a href="{{ route('user.cart-items.index') }}"> <i class="fas fa-shopping-cart"></i>
                        <span>({{ auth()->user()->cart_items->count() }})</span> </a>
                @endif
            </div>;

            <div id="account-box" class="account-box">
                <p>username : {{ auth()->user()->name }}</span></p>
                <p>email : <span>{{ auth()->user()->email }}</span></p>
                <a href="{{ route('logout') }}" class="delete-btn">logout</a>
            </div>
        </div>
    </header>
@endauth
