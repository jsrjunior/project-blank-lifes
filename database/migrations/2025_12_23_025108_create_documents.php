<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            // Tipo do documento
            $table->foreignId('document_type_id')
                ->constrained('document_types')
                ->cascadeOnUpdate();

            // Dados do documento
            $table->string('number');

            // Polimórfico
            $table->morphs('documentable');

            $table->timestamps();
            $table->softDeletes();

            // Evita duplicidade do mesmo documento para o mesmo dono
            $table->unique([
                'document_type_id',
                'number',
                'documentable_id',
                'documentable_type'
            ], 'documents_unique_per_owner');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
