<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        if (Route::is('user.orders.index')) :
            return view('user.orders', ['orders' => auth()->user()->orders]);
        else :
            $this->authorize('viewAny', Order::class);
            return view('admin.orders', ['orders' => Order::all()]);
        endif;
    }

    public function create()
    {
        $items = auth()->user()->cart_items;
        $totalPrice = CartItem::totalPrice($items);

        return view('user.checkout', ['cartItems' => $items, 'totalPrice' => $totalPrice]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'totalPrice' => ['required', 'numeric', 'min:1'],
            'number' => ['required', 'regex:/^[0-9\s()+\-]+$/'],
            'method' => ['required', 'in:cash on delivery,credit card,paypal'],
            'building' => ['required', 'numeric', 'min:1'],
            'street' => ['required'],
            'city' => ['required', 'string'],
            'governorate' => ['required', 'string'],
            'country' => ['required', 'string'],
            'postal' => ['required', 'numeric', 'min:1'],
        ], [
            'number.regex' => 'Enter a valid phone number.',
        ]);

        $validator->setAttributeNames([
            'totalPrice' => 'total price',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $totalProducts = '';
        foreach (json_decode(request('cartItem')) as $cartItem) :
            $item = "{$cartItem->product->name} ({$cartItem->quantity})";
            $totalProducts .= $totalProducts == '' ? $item : ', ' . $item;
        endforeach;
        $address = "building no. {$request->input('building')}, {$request->input('street')}, {$request->input('governorate')}, {$request->input('country')} - {$request->input('postal')}";

        Order::create([
            'user_id' => auth()->id(),
            'phone' => $request->input('number'),
            'address' => $address,
            'total_products' => $totalProducts,
            'total_price' => $request->input('totalPrice'),
            'payment_method' => $request->input('method'),
        ]);

        auth()->user()->cart_items()->delete();
        return redirect()->route('user.orders.index')->with('success', 'Order Placed Successfully');
    }

    public function update(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $request->validate(['paymentStatus' => 'required|in:pending,completed']);
        $order->payment_status = $request->input('paymentStatus');
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'Updated Successfully');
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Deleted Successfully');
    }
}
