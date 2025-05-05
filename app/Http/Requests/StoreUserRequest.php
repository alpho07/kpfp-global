<?php

namespace App\Http\Requests;

use App\Rules\MoreThanOneWord;
use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name'     => [
                'required'
            ],
            'middle_name'     => [
                'sometimes'
            ],
            'last_name'     => [
                'required'
            ],
            'id_number'     => [
                'required',
                'unique:users',
            ],
            'phone'    => [
                'required',
                'unique:users',
            ],
            'email'    => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'roles.*'  => [
                'integer',
            ],
            'roles'    => [
                'required',
                'array',
            ],
        ];
    }
}
