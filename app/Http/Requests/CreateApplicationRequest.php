<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Set to true for simplicity. Adjust based on your authorization logic.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        
            'application_date' => 'required|date',
            'first_name' => 'required|string',
            'surname' => 'required|string',
            'preffered_name' => 'required|string'
        ];
        //     'country' => 'required|string',
        //     'county' => 'required|string',
        //     'town_city' => 'required|string',
        //     'affiliated_hospital' => 'required|string',
        //     'years_worked' => 'required|numeric',
        //     'preauth_inst_no_of_work_yrs' => 'required|numeric',
        //     'license_no' => 'required|string',
        //     'registration_no' => 'required|string',
        //     'job_group' => 'required|string',
        //     'monthly_salary' => 'required|numeric',
        //     'phone_no' => 'required|numeric',
        //     'email_' => 'required|email',
        //     'gender' => 'required|string',
        //     'date_of_birth' => 'required|date',
        //     'age_years' => 'required|integer',
        //     'date_to_begin' => 'required|date', // Consider revising the rule based on your actual requirements.
        //     'speciality' => 'required|string',
        //     'training_institution' => 'required|string',
        //     'funding_source' => 'required|string',
        //     'funding_source_yes_desc' => 'required|string',
        //     'emergency_first_name' => 'required|string',
        //     'emergency_surname' => 'required|string',
        //     'emergency_title' => 'required|string',
        //     'emergency_first_contact_no' => 'required|numeric',
        //     'emergency_second_contact_no' => 'required|numeric',
        //     'emergency_email' => 'required|email',
        //     'emergency_relationship' => 'required|json',
        //     'academic_history' => 'required|json',
        //     'references' => 'required|json',
        //     'employment' => 'required|json',
        // ];
    }
}
