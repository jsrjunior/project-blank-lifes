<?php

namespace App\Repositories\Concerns;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

trait WithPermissions
{
    /**
     * Overrides publishing fields data.
     *
     * @param HasRoles|HasPermissions
     */
    protected function syncPermissions($resource, $key = 'permissions')
    {
        $permissionIds = request()->input($key, []);
    
        // Pega as permissões correspondentes aos IDs
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name');
    
        // Sincroniza usando os nomes
        $resource->syncPermissions($permissions);
    }
}
