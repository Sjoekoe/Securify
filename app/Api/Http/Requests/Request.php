<?php
namespace App\Api\Http\Requests;

use Dingo\Api\Http\FormRequest;

class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        ];
    }

    /**
     * @return \App\Accounts\Account
     */
    public function getAccountFromRoute()
    {
        return $this->route('account');
    }

    /**
     * @return \App\Companies\Company
     */
    public function getCompanyFromRoute()
    {
        return $this->route('company');
    }

    /**
     * @return \App\Documents\Document
     */
    public function getDocumentFromRoute()
    {
        return $this->route('document');
    }

    /**
     * @return \App\Documents\Folders\Folder
     */
    public function getFolderFromRoute()
    {
        return $this->route('folder');
    }

    /**
     * @return \App\Incidents\Incident
     */
    public function getIncidentFromRoute()
    {
        return $this->route('incident');
    }
}
