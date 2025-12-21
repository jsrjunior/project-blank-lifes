<?php

namespace App\Policies;

use App\Policies\Concerns\CreateResource;
use App\Policies\Concerns\DeleteResource;
use App\Policies\Concerns\ListResource;
use App\Policies\Concerns\ManageResource;
use App\Policies\Concerns\UpdateResource;
use App\Policies\Concerns\RollbackResource;
use App\Policies\Concerns\AuditResource;
use App\Policies\Concerns\RejectResource;
use App\Policies\Concerns\ApproveResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization,
        ManageResource,
        ListResource,
        CreateResource,
        UpdateResource,
        DeleteResource;

    protected $resource = 'roles';
}
