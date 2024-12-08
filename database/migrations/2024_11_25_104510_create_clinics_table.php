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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->float('rating')->default(0);
            $table->string('link')->nullable();
            $table->string('link_name');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_verification')->default(0);
            $table->foreignId('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
