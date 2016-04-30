<?php
namespace App\Api\Vehicles\Requests;

use App\Api\Http\Requests\Request;

class StoreVehicleRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'license_plate' => 'required', 
        ];
    }
}
