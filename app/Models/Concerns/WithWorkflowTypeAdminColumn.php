<?php

namespace App\Models\Concerns;

trait WithWorkflowTypeAdminColumn
{
    /**
     * Get WorkflowType admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getWorkflowTypeAdminColumn($export = false)
    {
       return modelName($this->workflow_type);
    }
}
