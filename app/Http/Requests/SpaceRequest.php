<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpaceRequest extends FormRequest
{
    /*********************************************************************
     *
     * Function Name: SpaceRequest.authorize().
     * Purpose: Determine if the user is authorized to make this request.
     *
     * @return bool A boolean determining if the user is authorized.
     *
     ********************************************************************/
    public function authorize() {
        return false;
    }

    /*********************************************************************
     *
     * Function Name: SpaceRequest.rules().
     * Purpose: The validation rules that the request must follow.
     *
     * @return array An array of rules for the request to accommodate.
     *
     ********************************************************************/
    public function rules() {
        return [
            //
        ];
    }
}
