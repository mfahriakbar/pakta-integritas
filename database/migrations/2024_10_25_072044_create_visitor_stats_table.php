<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visitor_stats', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date');
            $table->integer('visit_count')->default(0);
            $table->timestamps();
            
            $table->unique('visit_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitor_stats');
    }
};