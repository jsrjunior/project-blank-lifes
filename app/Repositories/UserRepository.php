<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Concerns\WithTypes;
use App\Repositories\Concerns\WithSelectOptions;

class UserRepository extends CrudRepository
{
    use WithSelectOptions;
    use WithTypes;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = User::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name';
    }
}