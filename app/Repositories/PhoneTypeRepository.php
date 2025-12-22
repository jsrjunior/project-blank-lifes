<?php

namespace App\Repositories;


use App\Models\PhoneType;
use App\Repositories\Concerns\WithTypes;
use App\Repositories\Concerns\WithSelectOptions;

class PhoneTypeRepository extends CrudRepository
{
    use WithSelectOptions;
    use WithTypes;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = PhoneType::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'number';
    }
}