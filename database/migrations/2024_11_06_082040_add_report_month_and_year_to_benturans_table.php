<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('benturan', function (Blueprint $table) {
            $table->string('report_month')->nullable();
            $table->integer('report_year')->nullable();
        });
    }

    public function down()
    {
        Schema::table('benturan', function (Blueprint $table) {
            $table->dropColumn(['report_month', 'report_year']);
        });
    }
};
