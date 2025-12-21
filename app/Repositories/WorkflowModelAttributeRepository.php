<?php

namespace App\Repositories;

use App\Models\WorkflowModelAttribute;
use App\Repositories\Concerns\WithTimestamps;
use App\Repositories\Concerns\WithSelectOptions;

class WorkflowModelAttributeRepository extends CrudRepository
{
    use WithTimestamps;
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = WorkflowModelAttribute::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {

        return 'attribute_name';
    }
}
