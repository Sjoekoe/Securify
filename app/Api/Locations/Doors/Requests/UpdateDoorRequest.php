<?php
namespace App\Api\Locations\Doors\Requests;

use App\Api\Http\Requests\Request;

class UpdateDoorRequest extends Request
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
