<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use Spatie\Activitylog\LogOptions;


trait ActivitylogOptions
{

    public function getActivitylogOptions(): LogOptions
    {
        return new LogOptions([
            'update' => 'Update',
            'insert' => 'Insert',
            'create' => 'Create',
            'delete' => 'Delete',
            'restore' => 'Restaurar',
            'inactivate' => 'Inactivate',
            'reactivate' => 'Reactivate',
            'clone' => 'Clone',
            'suspend' => 'Suspend',
            'use_coupon' => 'Use Coupon',
            'download' => 'Download',

        ]);
    }
}
