<?php
namespace App\Companies;

use App\Accounts\Account;

class EloquentCompanyRepository implements CompanyRepository
{
    /**
     * @var \App\Companies\EloquentCompany
     */
    private $company;

    public function __construct(EloquentCompany $company)
    {
        $this->company = $company;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Companies\Company
     */
    public function create(Account $account, array $values)
    {
        $company = new EloquentCompany();
        $company->account_id = $account->id();
        $company->name = $values['name'];
        $company->email = array_get($values, 'email');
        $company->vat = array_get($values, 'vat');
        $company->telephone = array_get($values, 'telephone');

        if (array_key_exists('website', $values)) {
            $company->website = securify_protocol_prepend($values['website']);
        }

        $company->save();

        return $company;
    }

    /**
     * @param \App\Companies\Company $company
     * @param array $values
     * @return \App\Companies\Company
     */
    public function update(Company $company, array $values)
    {
        if (array_key_exists('name', $values)) {
            $company->name = $values['name'];
        }

        if (array_key_exists('email', $values)) {
            $company->email = $values['email'];
        }

        if (array_key_exists('vat', $values)) {
            $company->vat = $values['vat'];
        }

        if (array_key_exists('telephone', $values)) {
            $company->telephone = $values['telephone'];
        }

        if (array_key_exists('website', $values)) {
            $company->website = securify_protocol_prepend($values['website']);
        }

        $company->save();

        return $company;
    }

    /**
     * @param \App\Companies\Company $company
     */
    public function delete(Company $company)
    {
        $company->delete();
    }

    /**
     * @param int $id
     * @return \App\Companies\Company|null
     */
    public function find($id)
    {
        return $this->company->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \App\Accounts\Account
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->company->where('account_id', $account->id())
            ->paginate($limit);
    }
}
