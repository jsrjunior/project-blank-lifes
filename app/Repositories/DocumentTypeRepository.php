<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Life;
use App\Repositories\Concerns\WithTypes;
use App\Repositories\Concerns\WithSelectOptions;

class DocumentTypeRepository extends CrudRepository
{
    use WithSelectOptions;
    use WithTypes;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Address::class;

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