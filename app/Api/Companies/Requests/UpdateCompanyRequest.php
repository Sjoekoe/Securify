<?php
namespace App\Api\Companies\Requests;

use App\Api\Http\Requests\Request;

class UpdateCompanyRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->getAccountFromRoute()->id() == $this->getCompanyFromRoute()->account()->id();
    }

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
