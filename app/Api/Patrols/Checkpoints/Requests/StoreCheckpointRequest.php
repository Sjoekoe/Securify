<?php
namespace App\Api\Patrols\Checkpoints\Requests;

use App\Api\Http\Requests\Request;

class StoreCheckpointRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'door_id' => 'required',
        ];
    }
}
