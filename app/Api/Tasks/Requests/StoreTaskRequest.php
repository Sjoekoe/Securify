<?php
namespace App\Api\Tasks\Requests;

use App\Api\Http\Requests\Request;

class StoreTaskRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        // @todo implement date format rules
        return [
            'name' => 'required',
            'expected_start' => 'required',
            'expected_end' => 'required'
        ];
    }
}
