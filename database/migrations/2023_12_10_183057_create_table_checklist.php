<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableChecklist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('application_id');
            $table->bigInteger('scholarship_id');
            $table->char('aof_govt',3)->default('no')->nullable();
            $table->char('aof_ea',3)->default('no')->nullable();
            $table->char('commitment',3)->default('no')->nullable();
            $table->char('not_beneficiary',3)->default('no')->nullable();
            $table->char('completed_application',3)->default('no')->nullable();
            $table->longText('personal_statement')->nullable();
            $table->longText('cv')->nullable();
            $table->longText('certs')->nullable();
            $table->longText('national_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checklists');
    }
}
