<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentProofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_proofs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('application_id')->nullable();
            $table->bigInteger('scholarship_id')->nullable();
            $table->string('link')->nullable();
            $table->integer('proof')->default(0)->nullable();
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
        Schema::dropIfExists('payment_proofs');
    }
}
