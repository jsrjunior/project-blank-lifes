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
        Schema::create('phone_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('phones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('live_id')
                ->constrained('lives')
                ->cascadeOnDelete();

            $table->foreignId('phone_type_id')
                ->constrained('phone_types')
                ->restrictOnDelete();

            $table->integer('ddi');
            $table->integer('ddd');
            $table->string('number');
            $table->boolean('is_primary')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
