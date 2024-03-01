@extends('layout.app')

@section('title')
    Admin | products
@endsection

@section('body')
    <section class="add-products">
        <h1 class="title">shop products</h1>

        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h3>add product</h3>
            <input type="text" name="name" class="box" placeholder="enter product name" required>
            <input type="number" name="price" class="box" placeholder="enter product price" min="0" required>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>
            <input type="submit" class="btn" value="add product">
        </form>
    </section>

    <section class="show-products">
        <div class="box-container">
            @forelse ($products as $product)
                <div class="box">
                    <img src="{{ url('storage/' . $product->image) }}" alt="">
                    <div class="name">{{ $product->name }}</div>
                    <div class="price">${{ $product->price }}/-</div>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="option-btn">update</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('delete this product?');" class="delete-btn">delete</button>
                    </form>
                </div>
            @empty
                <p class="empty">no products added yet!</p>
            @endforelse
        </div>
    </section>

    @isset($editingProduct)
        <section class="edit-product-form">
            <form action="{{ route('admin.products.update', $editingProduct->id) }}" method="post"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <img src="{{ url('storage/' . $editingProduct->image) }}" alt="">
                <input type="text" name="name" value="{{ $editingProduct->name }}" class="box"
                    requiredplaceholder="enter product name">
                <input type="number" name="price" value="{{ $editingProduct->price }}" min="0" class="box" required
                    placeholder="enter product price">
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
                <input type="submit" name="updateProduct" value="update" class="btn">
                <a class="option-btn" href="{{ route('admin.products.index') }}">cancel</a>
            </form>
        </section>
    @endisset
@endsection
