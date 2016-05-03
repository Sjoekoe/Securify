<?php
namespace App\Api\Todos\Requests;

use App\Api\Http\Requests\Request;

class ShowTodoRequest extends Request
{
    public function authorize()
    {
        return $this->getAccountFromRoute()->id() == $this->getTodoFromRoute()->account()->id(); 
    }
}
