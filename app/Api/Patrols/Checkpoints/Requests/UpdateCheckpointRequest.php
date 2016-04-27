<?php
namespace App\Api\Patrols\Checkpoints\Requests;

use App\Api\Http\Requests\Request;

class UpdateCheckpointRequest extends Request
{
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
