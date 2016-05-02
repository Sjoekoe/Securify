<?php
namespace App\Api\Http\Controllers\Accounts\Companies;

use App\Accounts\Account;
use App\Api\Companies\Requests\DeleteCompanyRequest;
use App\Api\Accounts\Requests\ShowAccountRequest;
use App\Api\Companies\CompanyTransformer;
use App\Api\Companies\Requests\ShowCompanyRequest;
use App\Api\Companies\Requests\StoreCompanyRequest;
use App\Api\Companies\Requests\UpdateCompanyRequest;
use App\Api\Http\Controller;
use App\Companies\Company;
use App\Companies\CompanyRepository;

class CompanyController extends Controller
{
    /**
     * @var \App\Companies\CompanyRepository
     */
    private $companies;

    public function __construct(CompanyRepository $companies)
    {
        $this->companies = $companies;
    }

    public function index(Account $account)
    {
        $companies = $this->companies->findByAccountPaginated($account);

        return $this->response()->paginator($companies, new CompanyTransformer());
    }

    public function store(StoreCompanyRequest $request, Account $account)
    {
        $company = $this->companies->create($account, $request->all());

        return $this->response()->item($company, new CompanyTransformer());
    }

    public function show(ShowCompanyRequest $request, Account $account, Company $company)
    {
        return $this->response()->item($company, new CompanyTransformer());
    }

    public function update(UpdateCompanyRequest $request, Account $account, Company $company)
    {
        $company = $this->companies->update($company, $request->all());

        return $this->response()->item($company, new CompanyTransformer());
    }

    public function delete(DeleteCompanyRequest $request, Account $account, Company $company)
    {
        $this->companies->delete($company);

        return $this->response()->noContent();
    }
}
