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
        //
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('total_harga');
            $table->enum('status', ['pending', 'paid', 'shipped']);
            $table->text('alamat_pengiriman');
            $table->string('kota');
            $table->string('kode_pos');
            $table->string('no_telepon');
            $table->enum('metode_pembayaran',['COD']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('pesanan');
    }
};
