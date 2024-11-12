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
            $table->string('subject_position_other')->nullable(); // Kolom baru untuk menyimpan data "Lainnya"
        });
    }

    public function down()
    {
        Schema::table('benturan', function (Blueprint $table) {
            $table->dropColumn('subject_position_other');
        });
    }
};
