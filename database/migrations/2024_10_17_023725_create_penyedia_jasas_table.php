<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyediaJasasTable extends Migration
{
    public function up()
    {
        Schema::create('penyedia_jasas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rekan');
            $table->string('alamat');
            $table->string('hubungan');
            $table->string('pegawai_penghubung');
            $table->string('no_telepon', 13);
            $table->enum('legalitas', ['Sesuai', 'Tidak Sesuai']);
            $table->enum('kualifikasi', ['Unit Dagang', 'CV', 'PT', 'Lainnya']);
            $table->enum('sumber_daya', ['Sesuai', 'Tidak Sesuai']);
            $table->enum('anti_penyuapan', ['Iya', 'Tidak']);
            $table->enum('kasus_penyuapan', ['Iya', 'Tidak']);
            $table->string('mekanisme_transaksi');
            $table->string('nib');
            $table->enum('kesimpulan', ['Memenuhi Persyaratan', 'Tidak Memenuhi Persyaratan']);
            $table->string('tim_kepatuhan');
            $table->string('tempat');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penyedia_jasas');
    }
}
