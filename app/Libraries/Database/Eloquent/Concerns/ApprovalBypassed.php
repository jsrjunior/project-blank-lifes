<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

trait ApprovalBypassed
{
    /**
     * Check if the workflow approval can be bypassed based on the presence in the workflow table.
     *
     * @return bool
     */
    public function isApprovalBypassed(): bool
    {
        $className = get_class($this);
        $exists = DB::table('workflows')
                    ->where('workflow_type', $className)
                    ->exists();
        return !$exists;
    }
}

