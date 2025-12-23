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
    $this->createAndGrantPermission('manage document_types');
        $this->createAndGrantPermission('list document_types');
        $this->createAndGrantPermission('import document_types');
        $this->createAndGrantPermission('export document_types');
        $this->createAndGrantPermission('view document_types');
        $this->createAndGrantPermission('delete document_types');
        $this->createAndGrantPermission('restore document_types');
        $this->createAndGrantPermission('download document_types');
        $this->createAndGrantPermission('approve document_types');
        $this->createAndGrantPermission('reject document_types');
        $this->createAndGrantPermission('audit document_types');
        $this->createAndGrantPermission('rollback document_types');
        $this->createAndGrantPermission('create document_types');
        $this->createAndGrantPermission('update document_types');
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
