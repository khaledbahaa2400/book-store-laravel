<form action="{{ route('user.cart-items.store', ['id' => $product->id]) }}" method="post" class="box">
    @csrf
    <img class="image" src="{{ url('storage/' . $product->image) }}" alt="">
    <div class="name">{{ $product->name }}</div>
    <div class="price">${{ $product->price }}/-</div>
    <input type="number" name="quantity" min="1" value="1" class="qty">
    <input type="submit" value="add to cart" class="btn">
</form>
