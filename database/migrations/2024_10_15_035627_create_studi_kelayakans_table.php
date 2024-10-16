<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiKelayakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studi_kelayakans', function (Blueprint $table) {
            $table->id();  // Kolom ID (Auto Increment)
            $table->string('nama_pengguna');
            $table->string('alamat');
            $table->string('hubungan');
            $table->string('nama_penghubung');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('nama_perusahaan');
            $table->string('nama_perorangan');
            $table->string('alamat_ada');
            $table->string('no_telp_ada');
            $table->string('email_ada');
            $table->string('pembayaran_langsung');  
            $table->string('pembayaran_sebelum');  
            $table->string('harga_sesuai');  
            $table->string('no_identitas');
            $table->string('nama_pemilik');
            $table->text('kesimpulan');
            $table->string('tim_kepatuhan');
            $table->string('tempat');
            $table->date('tanggal');
            $table->string('nama_pelaksana');
            $table->string('dokumen')->nullable();
            $table->timestamps();  // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studi_kelayakans');
    }
}
