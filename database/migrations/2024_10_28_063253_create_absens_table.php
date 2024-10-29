<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create activities table
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->date('activity_date');
            $table->string('responsible');
            $table->integer('participant_count');
            $table->string('account_code')->nullable();
            $table->text('objective');
            $table->text('summary');
            $table->timestamps();
        });

        // Create participants table
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('position');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
        Schema::dropIfExists('activities');
    }
};