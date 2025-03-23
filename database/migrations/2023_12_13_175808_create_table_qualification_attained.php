<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQualificationAttained extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_attained', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checklist')->nullable();
            $table->bigInteger('application_id')->nullable();
            $table->bigInteger('scholarship_id')->nullable();
            $table->string('training_institution')->nullable();
            $table->string('training_institution_start_date')->nullable();
            $table->string('training_institution_completion')->nullable();
            $table->string('training_institution_attained')->nullable();
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
        Schema::dropIfExists('qualification_attained');
    }
}
