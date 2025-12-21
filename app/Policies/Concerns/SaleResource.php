<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait SaleResource
{
    /**
     * Determine whether the user can sale the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function sale(User $user)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('sale '. $this->resource);
    }
}
