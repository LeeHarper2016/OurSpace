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
        return true;
    }

    /*********************************************************************
     *
     * Function Name: SpaceRequest.rules().
     * Purpose: The validation rules that the request must follow.
     *
     * @param bool $requireImages Boolean that determines if images must
     *              be recorded within the request.
     * @return array An array of rules for the request to accommodate.
     *
     ********************************************************************/
    public function rules(bool $requireImages) {
        if ($requireImages) {
            return [
                'name' => 'required',
                'description' => 'required',
                'icon_picture' => ['image', 'required'],
                'banner_picture' => ['image', 'required']
            ];
        } else {
            return [
                'name' => 'required',
                'description' => 'required',
                'icon_picture' => 'image',
                'banner_picture' => 'image'
            ];
        }
    }
}
