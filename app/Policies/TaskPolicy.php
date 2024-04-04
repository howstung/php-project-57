<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TaskPolicy extends BasePolicy
{
    public function delete(?User $user, Model $task): bool
    {
        return Auth::id() === $task->author->id;
    }
}
