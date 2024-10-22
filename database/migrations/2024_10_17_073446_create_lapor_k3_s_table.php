<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporK3sTable extends Migration
{
    public function up()
    {
        Schema::create('lapor_k3s', function (Blueprint $table) {
            $table->id();
            $table->date('incident_date');
            $table->time('incident_time');
            $table->string('location');
            $table->string('department');
            $table->string('incident_type');
            $table->string('treatment');
            $table->enum('repeated_incident', ['Ya', 'Tidak']);
            $table->integer('incident_number')->nullable();
            $table->string('potential_assessment');
            $table->text('description');
            $table->string('evidence')->nullable();
            $table->text('cause_analysis');
            $table->text('immediate_actions');
            $table->text('corrective_actions');
            $table->string('reporter');
            $table->string('victims');
            $table->string('witnesses');
            $table->string('supervisor');
            $table->text('reporterSignature');
            $table->string('reporter_email');
            $table->text('supervisorSignature');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lapor_k3s');
    }
}