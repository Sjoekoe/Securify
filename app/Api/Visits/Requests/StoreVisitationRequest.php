<?php
namespace App\Api\Visits\Requests;

use App\Api\Http\Requests\Request;

class StoreVisitationRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'expected_arrival' => 'required',
            'expected_departure' => 'required',
            'employee.id' => 'required|min:1',
            'visitor.id' => 'required|min:1',
            'visitor.name' => 'required',
            'company.id' => 'required|min:1',
            'company.name' => 'required',
        ];
    }
}
