<?php
namespace App\Api\Companies\Requests;

use App\Api\Http\Requests\Request;

class ShowCompanyRequest extends Request
{
    public function authorize()
    {
        return $this->getAccountFromRoute()->id() == $this->getCompanyFromRoute()->account()->id();
    }
}
