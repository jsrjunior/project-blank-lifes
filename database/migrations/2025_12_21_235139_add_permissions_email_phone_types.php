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

        $this->createAndGrantPermission('manage email_types');
        $this->createAndGrantPermission('list email_types');
        $this->createAndGrantPermission('import email_types');
        $this->createAndGrantPermission('export email_types');
        $this->createAndGrantPermission('view email_types');
        $this->createAndGrantPermission('delete email_types');
        $this->createAndGrantPermission('restore email_types');
        $this->createAndGrantPermission('download email_types');
        $this->createAndGrantPermission('approve email_types');
        $this->createAndGrantPermission('reject email_types');
        $this->createAndGrantPermission('audit email_types');
        $this->createAndGrantPermission('rollback email_types');
        $this->createAndGrantPermission('create email_types');
        $this->createAndGrantPermission('update email_types');

        $this->createAndGrantPermission('manage phone_types');
        $this->createAndGrantPermission('list phone_types');
        $this->createAndGrantPermission('import phone_types');
        $this->createAndGrantPermission('export phone_types');
        $this->createAndGrantPermission('view phone_types');
        $this->createAndGrantPermission('delete phone_types');
        $this->createAndGrantPermission('restore phone_types');
        $this->createAndGrantPermission('download phone_types');
        $this->createAndGrantPermission('approve phone_types');
        $this->createAndGrantPermission('reject phone_types');
        $this->createAndGrantPermission('audit phone_types');
        $this->createAndGrantPermission('rollback phone_types');
        $this->createAndGrantPermission('create phone_types');
        $this->createAndGrantPermission('update phone_types');
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
