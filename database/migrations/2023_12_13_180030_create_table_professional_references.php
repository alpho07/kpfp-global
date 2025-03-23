<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProfessionalReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_references', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checklist')->nullable();
            $table->bigInteger('application_id')->nullable();
            $table->bigInteger('scholarship_id')->nullable();
            $table->string('reference_title')->nullable();
            $table->string('reference_full_name')->nullable();
            $table->string('reference_organization')->nullable();
            $table->string('reference_phone_no')->nullable();
            $table->string('reference_email')->nullable();
            $table->string('reference_job_title')->nullable();
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
        Schema::dropIfExists('professional_references');
    }
}
