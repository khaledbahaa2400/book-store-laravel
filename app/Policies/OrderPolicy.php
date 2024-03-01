<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->type !== 'user';
    }

    public function update(User $user, Order $order): bool
    {
        return $user->type !== 'user';
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->type !== 'user';
    }
}
