<?php
namespace App\Api\Todos\Requests;

use App\Api\Http\Requests\Request;

class UpdateTodoRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->getAccountFromRoute()->id() == $this->getTodoFromRoute()->account()->id();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'account_date_format',
        ];
    }
}
