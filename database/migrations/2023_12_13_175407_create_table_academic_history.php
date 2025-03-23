<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAcademicHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_history', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checklist')->nullable();
            $table->bigInteger('application_id')->nullable();
            $table->bigInteger('scholarship_id')->nullable();
            $table->string('academic_university')->nullable();
            $table->string('academic_start_date')->nullable();
            $table->string('academic_completion')->nullable();
            $table->string('academic_diplomas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_history');
    }
}
