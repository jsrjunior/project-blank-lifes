<?php

namespace App\Repositories;

use App\Models\WorkflowModel;
use App\Repositories\Concerns\WithTimestamps;
use App\Repositories\Concerns\WithSelectOptions;

class WorkflowModelRepository extends CrudRepository
{
    use WithTimestamps;
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = WorkflowModel::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'model_type';
    }
}
