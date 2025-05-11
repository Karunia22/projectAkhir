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
        Schema::create('penugasan_teknisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teknisi_id')->constrained('teknisi')->onDelete('cascade');
            $table->foreignId('permintaan_id')->constrained('permintaan_servis')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('penugasan_teknisi');
    }
};
