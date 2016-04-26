<?php
namespace App\Api\Patrols\Requests;

use App\Api\Http\Requests\Request;

class StorePatrolRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
