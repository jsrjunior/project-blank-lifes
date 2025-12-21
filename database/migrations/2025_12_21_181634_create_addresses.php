<?php

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
        Schema::create('address_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('life_id')
                ->constrained('lifes')
                ->cascadeOnDelete();

            $table->foreignId('address_type_id')
                ->constrained('address_types')
                ->restrictOnDelete();

            $table->string('zipcode', 10);
            $table->string('street');               
            $table->string('number', 20)->nullable(); 
            $table->string('complement')->nullable();
            $table->string('district');         
            $table->string('city');
            $table->string('state', 2);              
            $table->string('country')->default('BR');
            $table->boolean('is_primary')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['life_id', 'is_primary']);
            $table->index('zipcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('address_types');
    }
};
