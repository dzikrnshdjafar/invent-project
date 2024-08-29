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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_peminjam');
            $table->string('alamat');
            $table->string('nip_nik');
            $table->string('no_hp');
            $table->text('keterangan')->nullable();
            $table->integer('loan_duration')->nullable();
            $table->integer('quantity');
            $table->date('return_date')->nullable();
            $table->string('status'); // Status can be 'borrowed' or 'returned'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
