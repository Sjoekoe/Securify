<?php
namespace App\Api\Companies\Requests;

use App\Api\Http\Requests\Request;

class StoreCompanyRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>'required',
            'website' => 'url_host',
            'email' => 'email'
        ];
    }
}
