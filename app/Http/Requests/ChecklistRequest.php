<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChecklistRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust the authorization logic if needed
    }

    public function rules()
    {
        return [
            //'application_id' => 'required|numeric',
            'scholarship_id'=>'sometimes',
            'aof_govt' => 'sometimes',
            'aof_ea' => 'sometimes',
            'commitment' => 'sometimes',
            'not_beneficiary' => 'sometimes',
            'completed_application' => 'sometimes',
            'personal_statement' => 'required|mimes:pdf|max:2048',
            'cv' => 'sometimes|file|mimes:pdf|max:5120', // PDF, 2 MB max
            'certs' => 'sometimes|file|mimes:pdf|max:20480', // Image, 10 MB max
            'national_id' => 'sometimes|file|mimes:pdf,jpeg,png,gif|max:2048', // Image, 1 MB max
        ];
    }
}
