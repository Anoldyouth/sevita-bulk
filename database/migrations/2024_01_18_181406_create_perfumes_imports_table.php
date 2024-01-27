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
        Schema::create('perfumes_imports', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status');
            $table->string('file');
            $table->unsignedInteger('chunks_count')->nullable();
            $table->unsignedInteger('chunks_finished')->default(0);
            $table->text('message')->nullable();
            $table->timestamps(6);
        });

        Schema::create('perfumes_import_errors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('import_id')->constrained('perfumes_imports')->cascadeOnDelete();
            $table->unsignedBigInteger('row_num');
            $table->string('message');
            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfumes_import_errors');
        Schema::dropIfExists('perfumes_imports');
    }
};
