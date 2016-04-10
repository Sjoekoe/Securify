<?php
namespace App\Api\Users\Requests;

use App\Api\Http\Requests\Request;

class StoreUserRequest extends Request 
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email|required',
        ];
    }
}
