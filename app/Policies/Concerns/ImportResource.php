<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ImportResource
{
    /**
     * Determine whether the user can import the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function import(User $user)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('import '. $this->resource);
    }
}
