<?php

namespace App\Policies;

use App\Policies\Concerns\CreateResource;
use App\Policies\Concerns\ImportResource;
use App\Policies\Concerns\DeleteResource;
use App\Policies\Concerns\ListResource;
use App\Policies\Concerns\ManageResource;
use App\Policies\Concerns\RestoreResource;
use App\Policies\Concerns\UpdateResource;
use App\Policies\Concerns\DownloadResource;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressTypePolicy
{
    use HandlesAuthorization,
        ManageResource,
        ListResource,
        CreateResource,
        UpdateResource,
        DeleteResource,
        RestoreResource,
        ImportResource,
        DownloadResource;

    protected $resource = 'address_types';
}
