<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->role === 2;
    }

    public function update(User $user): bool
    {
        return $user->role === 1;
    }
}
