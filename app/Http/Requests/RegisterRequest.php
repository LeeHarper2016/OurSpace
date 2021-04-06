<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{

    /*********************************************************************
     *
     * Function Name: RegisterRequest.authorize().
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
     * Function Name: RegisterRequest.rules().
     * Purpose: The validation rules that the request must follow.
     *
     * @return array An array of rules for the request to accommodate.
     *
     ********************************************************************/
    public function rules() {
        return [
            'name' => 'required',
            'email' => 'unique:App\Models\User,email',
            'password' => ['required', 'same:passwordCheck'],
            'passwordCheck' => 'required'
        ];
    }
}
