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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->onDelete('cascade');
            $table->enum('metode_pembayaran',['cod','transfer']);
            $table->integer('jumlah');
            $table->string('COD')->nullable();
            $table->string('Butkti Transfer')->nullable();
            $table->enum('status_pembayaran',['peding','terverifikasi','ditolak'])->default('peding');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
