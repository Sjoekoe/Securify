<?php
namespace App\Api\Documents\Requests;

use App\Api\Http\Requests\Request;

class ShowDocumentRequest extends Request
{
    public function authorize()
    {
        return $this->getAccountFromRoute()->id() == $this->getDocumentFromRoute()->account()->id();
    }
}
