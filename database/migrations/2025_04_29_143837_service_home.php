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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_role');
            $table->timestamps();
        });

        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');;
            $table->string('no_telepon');
            $table->timestamps();
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_produk');
            $table->timestamps();
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->integer('stok');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');  // Penyesuaian pada nama kolom
            $table->string('img_url');
            $table->timestamps();
        });
        
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('pengguna')->onDelete('cascade');  // Penyesuaian pada nama kolom
            $table->integer('total_harga');
            $table->enum('status', ['pending', 'paid', 'shipped']);
            $table->text('alamat_pengiriman');
            $table->string('kota');
            $table->string('kode_pos');
            $table->string('no_telepon');
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
        
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->onDelete('cascade');  // Penyesuaian pada nama kolom
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');  // Penyesuaian pada nama kolom
            $table->integer('jumlah');
            $table->integer('total_harga');
        });

        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('pengguna')->onDelete('cascade');  // Penyesuaian pada nama kolom
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');  // Penyesuaian pada nama kolom
            $table->integer('jumlah');
        });

        Schema::create('layanan_servis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->timestamps();
        });

        Schema::create('permintaan_servis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('pengguna')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanan_servis')->onDelete('cascade');
            $table->text('alamat');
            $table->date('jadwal');
            $table->enum('status', ['pending', 'scheduled', 'done', 'canceled']);
            $table->string('no_telepon');
            $table->timestamps();
        });

        Schema::create('teknisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon');
            $table->timestamps();
        });

        Schema::create('penugasan_teknisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teknisi_id')->constrained('teknisi')->onDelete('cascade');
            $table->foreignId('permintaan_id')->constrained('permintaan_servis')->onDelete('cascade');  
        });
    }

    public function down()
    {
        Schema::dropIfExists('penugasan_teknisi');
        Schema::dropIfExists('teknisi');
        Schema::dropIfExists('permintaan_servis');
        Schema::dropIfExists('layanan_servis');
        Schema::dropIfExists('keranjang');
        Schema::dropIfExists('detail_pesanan');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('pengguna');
    }
};
