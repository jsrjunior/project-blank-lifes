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
        Schema::create('email_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ex: Pessoal, Comercial, Financeiro
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('emails', function (Blueprint $table) {
            $table->id();

            // Vínculo com a entidade principal
            $table->foreignId('life_id')
                ->constrained('lifes')
                ->cascadeOnDelete();

            // Tipo do e-mail
            $table->foreignId('email_type_id')
                ->constrained('email_types')
                ->restrictOnDelete();

            // Dados do e-mail
            $table->string('email')->unique();

            // Controle
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_verified')->default(false);

            $table->timestamps();
            $table->softDeletes();

            // Índices úteis
            $table->index(['life_id', 'is_primary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
        Schema::dropIfExists('email_types');
    }
};
