<?php
namespace App\Api\Documents\Requests;

use App\Api\Http\Requests\Request;

class UpdateDocumentRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->getAccountFromRoute()->id() == $this->getDocumentFromRoute()->account()->id();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
