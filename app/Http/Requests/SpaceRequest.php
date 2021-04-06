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
     * @return array An array of rules for the request to accommodate.
     *
     ********************************************************************/
    public function rules() {
        switch($this->method()) {
            case 'POST':{
                return [
                    'name' => 'required',
                    'description' => 'required',
                    'icon_picture' => ['image', 'required'],
                    'banner_picture' => ['image', 'required']
                ];
            }
            case 'PATCH':
            case 'PUT': {
                return [
                    'name' => 'required',
                    'description' => 'required',
                    'icon_picture' => 'image',
                    'banner_picture' => 'image'
                ];
            }
            default: break;
        }
    }
}
