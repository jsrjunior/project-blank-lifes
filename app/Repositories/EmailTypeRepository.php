<?php

namespace App\Repositories;

use App\Models\Email;
use App\Models\EmailType;
use App\Models\Life;
use App\Repositories\Concerns\WithTypes;
use App\Repositories\Concerns\WithSelectOptions;

class EmailTypeRepository extends CrudRepository
{
    use WithSelectOptions;
    use WithTypes;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = EmailType::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'email';
    }
}