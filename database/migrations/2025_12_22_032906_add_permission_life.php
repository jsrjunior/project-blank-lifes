<?php

use App\Services\PermissionBatch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->createAndGrantPermission('manage lives');
        $this->createAndGrantPermission('list lives');
        $this->createAndGrantPermission('import lives');
        $this->createAndGrantPermission('export lives');
        $this->createAndGrantPermission('view lives');
        $this->createAndGrantPermission('delete lives');
        $this->createAndGrantPermission('restore lives');
        $this->createAndGrantPermission('download lives');
        $this->createAndGrantPermission('approve lives');
        $this->createAndGrantPermission('reject lives');
        $this->createAndGrantPermission('audit lives');
        $this->createAndGrantPermission('rollback lives');
        $this->createAndGrantPermission('create lives');
        $this->createAndGrantPermission('update lives');
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
