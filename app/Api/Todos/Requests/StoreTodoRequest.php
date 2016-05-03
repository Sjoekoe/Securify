<?php
namespace App\Api\Todos\Requests;

use App\Api\Http\Requests\Request;

class StoreTodoRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required|account_date_format',
        ];
    }
}
