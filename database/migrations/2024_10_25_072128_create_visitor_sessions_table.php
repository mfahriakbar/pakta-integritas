<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visitor_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->string('ip_address', 45);
            $table->date('visit_date');
            $table->timestamps();

            $table->unique(['session_id', 'visit_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitor_sessions');
    }
};