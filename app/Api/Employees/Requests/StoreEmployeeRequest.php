<?php
namespace App\Api\Employees\Requests;

use App\Api\Http\Requests\Request;

class StoreEmployeeRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email',
        ];
    }
}
