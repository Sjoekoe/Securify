<?php
namespace App\Companies;

use App\Accounts\Account;

interface CompanyRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Companies\Company
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Companies\Company $company
     * @param array $values
     * @return \App\Companies\Company
     */
    public function update(Company $company, array $values);
    
    /**
     * @param \App\Companies\Company $company
     */
    public function delete(Company $company);
    
    /**
     * @param int $id
     * @return \App\Companies\Company|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
