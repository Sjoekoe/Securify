<?php
namespace App\Api\Incidents\Requests;

use App\Api\Http\Requests\Request;

class ShowIncidentRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->getAccountFromRoute()->id() == $this->getIncidentFromRoute()->account()->id();
    }
}
