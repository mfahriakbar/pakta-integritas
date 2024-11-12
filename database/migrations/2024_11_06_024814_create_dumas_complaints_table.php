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
            $table->foreignId('dumas_id')->constrained()->onDelete('cascade');
            $table->string('complaint_channel');
            $table->string('complaint_type')->nullable();
            $table->text('handling')->nullable();
            $table->string('remarks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dumas_complaints');
    }
};
