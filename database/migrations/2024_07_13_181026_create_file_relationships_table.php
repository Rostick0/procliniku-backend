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
        Schema::create('file_rels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->morphs('file_relable');
            $table->enum('type', ['sertificate', 'license'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_rels');
    }
};
