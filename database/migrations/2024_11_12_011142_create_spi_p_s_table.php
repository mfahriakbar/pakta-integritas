<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('spi_p', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->string('document_type')->nullable();
            $table->string('folder_path');
            $table->string('file_path');
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spi_p');
    }
};