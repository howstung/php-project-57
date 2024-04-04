<?php

namespace App\Policies;

use App\Models\User;

class BasePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user): bool
    {
        return true;
    }

    public function create(?User $user): bool
    {
        return $user !== null;
    }

    public function update(?User $user): bool
    {
        return $user !== null;
    }

    public function delete(?User $user): bool
    {
        return $user !== null;
    }
}
