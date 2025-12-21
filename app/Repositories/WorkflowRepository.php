<?php

namespace App\Repositories;

use App\Models\Workflow;
use App\Repositories\Concerns\WithTimestamps;
use App\Repositories\Concerns\WithSelectOptions;
use Illuminate\Support\Facades\Schema;


class WorkflowRepository extends CrudRepository
{
    use WithTimestamps;
    use WithSelectOptions;

    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Workflow::class;

    /**
     * Return the resource main column.
     *
     * @return string
     */
    public function getResourceLabel()
    {
        return 'name';
    }


      /**
     * Handles model after store.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterStore($resource, $attributes)
    {
        if (isset($attributes['roles'])) {
            $resource->roles()->sync($attributes['roles']);
        }
        if (isset($attributes['permissions'])) {
            $resource->permissions()->sync($attributes['permissions']);
        }
        return $resource;
    }

    /**
     * Handles model after update.
     *
     * @param Model $resource
     * @param array $attributes
     *
     * @return Model
     */
    public function afterUpdate($resource, $attributes)
    {
        if (isset($attributes['roles'])) {
            $resource->roles()->sync($attributes['roles']);
        }
        if (isset($attributes['permissions'])) {
            $resource->permissions()->sync($attributes['permissions']);
        }
        return $resource;
    }

     /**
     * Verifica se existe um workflow do tipo fornecido.
     *
     * @param string $workflowType
     * @return bool
     */
    public function existsByWorkflowType(string $workflowType): bool
    {
        // Verifica se a tabela 'workflows' existe antes de executar a consulta
        if (!Schema::hasTable('workflows')) {
            return false;
        }

        // Verifica se a coluna 'workflow_type' existe na tabela 'workflows'
        if (!Schema::hasColumn('workflows', 'workflow_type')) {
            return false;
        }

        return $this->exists(['workflow_type' => $workflowType]);
    }

    /**
     * Verifica se existe um workflow do tipo fornecido.
     *
     * @param string $workflowType
     * @return Workflow|null
     */
    public function findByWorkflowType(string $workflowType): ?Workflow
    {
        return $this->newQuery()->where('workflow_type', $workflowType)->first();
    }



}
