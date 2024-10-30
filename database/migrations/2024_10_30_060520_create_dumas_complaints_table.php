<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dumas_complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dumas_id');
            $table->string('complaint_channel');
            $table->string('complaint_type')->nullable();
            $table->text('handling')->nullable();
            $table->string('remarks');
            $table->timestamps();

            $table->foreign('dumas_id')
                  ->references('id')
                  ->on('dumas')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dumas_complaints');
    }
};