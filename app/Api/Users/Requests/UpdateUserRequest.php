<?php
namespace App\Api\Users\Requests;

use App\Api\Http\Requests\Request;
use App\Users\User;

class UpdateUserRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:' . User::TABLE . ',email,' . $user->id(),
        ];
    }
}
