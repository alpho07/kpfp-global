<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checklist')->nullable();
            $table->bigInteger('application_id')->nullable();
            $table->bigInteger('scholarship_id')->nullable();
            $table->date('application_date');  //date,required
            $table->string('first_name'); //required
            $table->string('surname'); //required
            $table->string('preffered_name'); //required
            $table->string('country'); //required
            $table->string('county'); //required
            $table->string('town_city'); //required
            $table->string('affiliated_hospital'); //required
            $table->string('years_worked'); //required,numeric
            $table->string('preauth_inst_no_of_work_yrs'); //required,numeric
            $table->string('license_no'); //required
            $table->string('registration_no'); //required
            $table->string('national_id_pass'); //required
            $table->string('job_group'); //required
            $table->float('monthly_salary'); //required,numeric
            $table->string('phone_no'); //required,numeric
            $table->string('email_'); //required,email
            $table->string('gender'); //required
            $table->date('date_of_birth'); //required,date
            $table->integer('age_years');
            $table->date('date_to_begin'); //required,numeric
            $table->string('speciality'); //required
            $table->string('training_institution_with'); //required
            $table->string('funding_source'); //required
            $table->string('funding_source_yes_desc'); //required

            $table->string('supervisor_title');//required
            $table->string('supervisor_full_name');//required
            $table->string('supervisor_designation');//required
            $table->string('supervisor_phone_no');//required
            $table->string('supervisor_email');//required
            $table->string('supervisor_department');//required



            $table->string('emergency_first_name');//required
            $table->string('emergency_surname');//required
            $table->string('emergency_title');//required
            $table->string('emergency_first_contact_no');//required,numeric
            $table->string('emergency_secondcontact_no');//required,numeric
            $table->string('emergency_email'); //required,email
            $table->string('emergency_relationship'); //required,email

            $table->string('reference_previous_1')->nullable(); //required
            $table->string('reference_previous_2')->nullable(); //required
            $table->string('reference_previous_3')->nullable(); //required

            $table->string('authorized')->nullable(); //required
            $table->string('verification_status')->nullable(); //required

            $table->string('authorized_form')->default('Not Uploaded')->nullable(); //required

            $table->string('short_listing_status')->default('None')->nullable(); //required
            $table->string('short_listed_by')->nullable(); //required

            $table->string('bonding_form')->default('Not Sent')->nullable(); //required
            $table->string('stage')->default('0%')->nullable(); //required


            $table->longText('comments')->nullable(); //required
            $table->string('verified_by')->nullable(); //required
            $table->string('payment_verified')->default('No')->nullable(); //required


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
        Schema::dropIfExists('applications');
    }
}
