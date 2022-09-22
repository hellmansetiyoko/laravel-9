<?php

namespace App\Policies;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BiodataPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Biodata $biodata)
    {
        return $user->id === $biodata->user_id;
    }
}
