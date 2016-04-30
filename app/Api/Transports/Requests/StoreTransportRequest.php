<?php
namespace App\Api\Transports\Requests;

use App\Api\Http\Requests\Request;

class StoreTransportRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'product' => 'required',
        ];
    }
}
