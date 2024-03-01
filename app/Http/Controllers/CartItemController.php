<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index()
    {
        $items = auth()->user()->cart_items;
        $totalPrice = CartItem::totalPrice($items);

        return view('user.cart', ['cartItems' => $items, 'totalPrice' => $totalPrice]);
    }

    public function store(Request $request)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $id = request('id');
        $cart_item = auth()->user()->cart_items()->where('product_id', $id)->first();
        if (isset($cart_item)) :
            $cart_item->quantity += request('quantity');
            $cart_item->save();
        else :
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => request('quantity'),
            ]);
        endif;

        return back()->with('success', 'Product Added Successfully');
    }
    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorize('update', $cartItem);

        $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem->quantity = request('quantity');
        $cartItem->save();
        return redirect()->route('user.cart-items.index')->with('success', 'Updated Successfully');
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);

        $cartItem->delete();
        return redirect()->route('user.cart-items.index')->with('success', 'Deleted Successfully');
    }

    public static function destroyAll()
    {
        auth()->user()->cart_items()->delete();
        return redirect()->route('user.cart-items.index')->with('success', 'Cart is now Empty');
    }
}
