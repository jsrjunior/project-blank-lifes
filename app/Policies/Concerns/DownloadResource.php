<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait DownloadResource
{
    /**
     * Determine whether the user can export the resource.
     *
     * @param User $user
     * @return mixed
     */
    public function download(User $user)
    {
        return $user->can('manage all') || $user->can('manage '. $this->resource) || $user->can('download '. $this->resource);
    }
}
