<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{

    /*********************************************************************
     *
     * Function Name: LoginRequest.attributes().
     * Purpose: Sets the attribute names for the field values.
     *
     * @return array An array of fields with their associated attribute name.
     *
     ********************************************************************/
    public function attributes() {
        return [
            'email' => 'email address',
            'password' => 'password'
        ];
    }

    /*********************************************************************
     *
     * Function Name: LoginRequest.authorize().
     * Purpose: Determine if the user is authorized to make this request.
     *
     * @return bool A boolean determining if the user is authorized.
     *
     ********************************************************************/
    public function authorize() {
        return is_null(Auth::user());
    }

    /*********************************************************************
     *
     * Function Name: LoginRequest.rules().
     * Purpose: The validation rules that the request must follow.
     *
     * @return array An array of rules for the request to accommodate.
     *
     ********************************************************************/
    public function rules() {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }
}
