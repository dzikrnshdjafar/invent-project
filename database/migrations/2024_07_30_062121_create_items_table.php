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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('condition')->nullable(); // Kolom untuk kondisi item (new, used, damaged)
            $table->string('category')->nullable(); // Kolom untuk kategori item (it, furniture, electronics)
            $table->string('image')->nullable(); // Kolom untuk path gambar
            $table->timestamps();
            $table->softDeletes(); // Kolom untuk soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
