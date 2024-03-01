<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userIndex()
    {
        return view('user.homepage', ['products' => Product::take(6)->get()]);
    }

    public function adminIndex()
    {
        $params = [
            'users_count' => User::where('type', 'user')->count(),
            'admins_count' => User::where('type', 'admin')->count(),
            'supers_count' => User::where('type', 'super admin')->count(),
            'products_count' => Product::count(),
            'messages_count' => Message::count(),
            'orders_count' => Order::count(),
            'total_pendings' => Order::where('payment_status', 'pending')->sum('total_price'),
            'total_completed' => Order::where('payment_status', 'completed')->sum('total_price'),
        ];
        return view('admin.homepage', $params);
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view('admin.users', ['users' => User::all()]);
    }

    public function authenticate()
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (auth()->attempt($validated)) :
            request()->session()->regenerate();

            if (auth()->user()->type === 'user') :
                return redirect()->route('user.home');
            else :
                return redirect()->route('admin.home');
            endif;
        endif;

        return redirect()->route('login')->with('error', 'Incorrect Credentials');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'type' => 'in:user,admin,super-admin',
        ]);

        if (request('type')) :
            $this->authorize('create', [User::class, request('type')]);
            User::create($validated);
            return redirect()->route('admin.users.index')->with('success', 'User Added Successfully');
        endif;

        $user = User::create($validated);
        $request->session()->regenerate();
        auth()->login($user);
        return redirect()->route('user.home');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User Deleted Successfully');
    }
}
