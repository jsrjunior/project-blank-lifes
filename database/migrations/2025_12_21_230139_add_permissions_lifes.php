<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Services\PermissionBatch;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        $this->createAndGrantPermission('manage address_types');
        $this->createAndGrantPermission('list address_types');
        $this->createAndGrantPermission('import address_types');
        $this->createAndGrantPermission('export address_types');
        $this->createAndGrantPermission('view address_types');
        $this->createAndGrantPermission('delete address_types');
        $this->createAndGrantPermission('restore address_types');
        $this->createAndGrantPermission('download address_types');
        $this->createAndGrantPermission('approve address_types');
        $this->createAndGrantPermission('reject address_types');
        $this->createAndGrantPermission('audit address_types');
        $this->createAndGrantPermission('rollback address_types');
        $this->createAndGrantPermission('create address_types');
        $this->createAndGrantPermission('update address_types');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    private function createAndGrantPermission($permission)
    {
        (new PermissionBatch())
            ->pushAdminRole()
            ->pushPermission($permission)
            ->grant();
    }
};
