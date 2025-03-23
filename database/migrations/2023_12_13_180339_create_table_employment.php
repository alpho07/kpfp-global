<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checklist')->nullable();
            $table->bigInteger('application_id')->nullable();
            $table->bigInteger('scholarship_id')->nullable();
            $table->string('previous_organization')->nullable();
            $table->string('previous_organization_from')->nullable();
            $table->string('reference_previous_organization_to')->nullable();
            $table->string('reference_previous_job_title')->nullable();
            $table->string('reference_previous_supervisor')->nullable();
            $table->string('reference_previous_responsibilities')->nullable();
            $table->string('reference_previous_phone_no')->nullable();
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
        Schema::dropIfExists('employment');
    }
}
