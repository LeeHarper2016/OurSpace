<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    /*********************************************************************
     *
     * Function Name: LoginRequest.authorize().
     * Purpose: Determine if the user is authorized to make this request.
     *
     * @return bool
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
     * @return array
     *
     ********************************************************************/
    public function rules() {
        return [
            'email' => 'required',
            'body' => 'required'
        ];
    }
}
