<?php
namespace App\Api\Companies\Requests;

use App\Api\Http\Requests\Request;

class DeleteCompanyRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->getAccountFromRoute()->id() == $this->getCompanyFromRoute()->account()->id();
    }
}
