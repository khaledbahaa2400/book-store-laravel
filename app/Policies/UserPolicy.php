<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->type !== 'user';
    }

    public function create(User $loggedInUser, $type): bool
    {
        if ($loggedInUser->type === 'super admin') {
            return true;
        }

        if ($loggedInUser->type === 'admin') {
            return $type === 'user';
        }

        return false;
    }

    public function delete(User $loggedInUser, $user)
    {
        if ($loggedInUser->id === $user->id)
            return false;

        if ($loggedInUser->type === 'super admin')
            return true;

        if ($loggedInUser->type === 'admin')
            return $user->type === 'user';

        return false;
    }
}
