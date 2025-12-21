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

        $this->createAndGrantPermission('manage users');
        $this->createAndGrantPermission('list users');
        $this->createAndGrantPermission('import users');
        $this->createAndGrantPermission('export users');
        $this->createAndGrantPermission('view users');
        $this->createAndGrantPermission('delete users');
        $this->createAndGrantPermission('restore users');
        $this->createAndGrantPermission('download users');
        $this->createAndGrantPermission('approve users');
        $this->createAndGrantPermission('reject users');
        $this->createAndGrantPermission('audit users');
        $this->createAndGrantPermission('rollback users');
        $this->createAndGrantPermission('create users');
        $this->createAndGrantPermission('update users');


        $this->createAndGrantPermission('manage roles');
        $this->createAndGrantPermission('list roles');
        $this->createAndGrantPermission('import roles');
        $this->createAndGrantPermission('export roles');
        $this->createAndGrantPermission('view roles');
        $this->createAndGrantPermission('delete roles');
        $this->createAndGrantPermission('restore roles');
        $this->createAndGrantPermission('download roles');
        $this->createAndGrantPermission('approve roles');
        $this->createAndGrantPermission('reject roles');
        $this->createAndGrantPermission('audit roles');
        $this->createAndGrantPermission('rollback roles');
        $this->createAndGrantPermission('create roles');
        $this->createAndGrantPermission('update roles');
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
