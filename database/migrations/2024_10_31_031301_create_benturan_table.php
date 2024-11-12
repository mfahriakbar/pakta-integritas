<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('benturan', function (Blueprint $table) {
            $table->id();
            $table->string('subject_position');
            $table->text('activity_type');
            $table->text('situation');
            $table->string('conflict_type');
            $table->text('handling_strategy');
            $table->boolean('declaration')->default(false); // Updated field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('benturan');
    }
};
