<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Applications extends Model
{
    //use HasFactory;



    protected $fillable = [
        "id",  //primary key increments
        'checklist',
        'status',
        "application_id", //bigInteger nulled
        "scholarship_id", //bigInteger nulled
        "application_date", //date
        "first_name", //string
        "surname", //string
        "preffered_name", //string
        "country", //string
        "county", //string
        "town_city", //string
        "affiliated_hospital", //string
        "years_worked", //string
        "preauth_inst_no_of_work_yrs", //integer
        "license_no", //string
        "registration_no", //string
        "job_group", //string
        "Monthly_salary", //floa
        "national_id_pass",
        "phone_no", //string
        "email_", //string
        "gender", //string
        "date_of_birth", //date
        "age_years", //integer
        "date_to_begin", //date
        "speciality", //string
        "training_institution_with", //string
        "funding_source", //string
        "funding_source_yes_desc", //string

        "supervisor_title", //required
        "supervisor_full_name", //required
        "supervisor_designation", //required
        "supervisor_phone_no",
        "supervisor_email",
        "supervisor_department",

        "emergency_first_name", //string
        "emergency_surname", //string
        "emergency_title", //string
        "emergency_first_contact_no", //string
        "emergency_secondcontact_no", //string
        "emergency_email", //email
        "emergency_relationship",
        "authorized_form",
        "bonding_form",
        "reference_previous_1", //string
        "reference_previous_2", //string
        "reference_previous_3", //string
        "authorized",
        "verification_status",
        "comments",
        "verified_by",
        'stage',
        'payment_verified'

    ];

    function authorized_form_link(): HasOne
    {
        return $this->hasOne(ApplicantsUploads::class, 'id','authorized_form');
    }

    function bonding_form_link(): HasOne
    {
        return $this->hasOne(ApplicantsUploads::class, 'id','bonding_form');
    }
}
