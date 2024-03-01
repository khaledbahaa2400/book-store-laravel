<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->type !== 'user';
    }

    public function delete(User $user, Message $message): bool
    {
        return $user->type !== 'user';
    }
}
