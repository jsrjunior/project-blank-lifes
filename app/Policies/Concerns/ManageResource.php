<?php

namespace App\Policies\Concerns;

use App\Models\User;
use App\Services\PermissionService;

trait ManageResource
{
    /**
     * Determine whether the user can manage the resource.
     *
     * @param User $user
     * @return bool
     */
    public function manage(User $user)
    {
        return $user->can('manage all') || $user->can("manage " . $this->resource);
    }




}
