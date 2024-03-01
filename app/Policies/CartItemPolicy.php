<?php

namespace App\Policies;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartItemPolicy
{
    public function update(User $user, CartItem $cartItem): bool
    {
        return $user->cart_items->contains('id', $cartItem->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CartItem $cartItem): bool
    {
        return $user->cart_items->contains('id', $cartItem->id);
    }
}
