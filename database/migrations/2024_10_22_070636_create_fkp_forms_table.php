<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFkpFormsTable extends Migration
{
    public function up()
    {
        Schema::create('fkp_forms', function (Blueprint $table) {
            $table->id();
            $table->string('message_type');
            $table->string('employee_name');
            $table->string('employee_id')->nullable();
            $table->string('position');
            $table->string('department');
            $table->string('company')->nullable();
            $table->string('subject');
            $table->text('problem_description');
            $table->text('proposed_solution');
            $table->string('reporter_email');
            // New fields
            $table->text('notes')->nullable(); // Catatan (diisi petugas)
            $table->string('prepared_by')->nullable(); // Disusun oleh
            $table->string('executor')->nullable(); // Pelaksana
            $table->string('secretary_approval')->nullable(); // Diterima (Sekretaris Komite K3)
            $table->string('chairman_approval')->nullable(); // Diperiksa (Ketua Komite K3)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fkp_forms');
    }
}