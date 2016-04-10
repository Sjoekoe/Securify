<?php
namespace App\Api\Users\Requests;

use App\Api\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email',
        ];
    }
}
