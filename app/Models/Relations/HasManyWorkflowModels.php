<?php

namespace App\Models\Relations;

use App\Models\Workflow;
use App\Models\WorkflowModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyWorkflowModels
{
    /**
     * Define a has-many relationship with WorkflowModel.
     *
     * @return HasMany
     */
    public function workflowModels(): HasMany
    {
        return $this->hasMany(Workflow::class, 'workflow_id', 'id');
    }
}
