<?php
namespace App\Api\Accounts\Requests;

use App\Api\Http\Requests\Request;

class StoreAccountRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
