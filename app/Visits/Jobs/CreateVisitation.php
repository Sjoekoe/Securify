<?php
namespace App\Visits\Jobs;

use App\Accounts\Account;
use App\Companies\Company;
use App\Companies\CompanyRepository;
use App\Database\CanMakeDatabaseTransactions;
use App\Database\TransactionManager;
use App\Employees\EmployeeRepository;
use App\Jobs\Job;
use App\Visitors\VisitorRepository;
use App\Visits\VisitRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateVisitation extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, CanMakeDatabaseTransactions;

    /**
     * @var array
     */
    private $values;

    /**
     * @var \App\Accounts\Account
     */
    private $account;

    public function __construct(Account $account, array $values)
    {
        $this->transactionManager = app(TransactionManager::class);
        $this->account = $account;
        $this->values = $values;
    }

    public function handle(
        EmployeeRepository $employees,
        CompanyRepository $companies,
        VisitorRepository $visitors,
        VisitRepository $visits
    ) {
        $this->transaction(function() use ($employees, $companies, $visitors, $visits) {
            $employee = $employees->find($this->values['employee']['id']);
            $company = $this->findOrCreateCompany($companies, $this->values['company']);
            $visitor = $this->findOrCreateVisitor($visitors, $company, $this->values['visitor']);
            $visit = $visits->create($this->account, $employee, $visitor, $this->values);

            return $visit;
        });
    }

    /**
     * @param \App\Companies\CompanyRepository $companies
     * @param array $values
     * @return \App\Companies\Company
     */
    private function findOrCreateCompany(CompanyRepository $companies, array $values)
    {
        $id = $values['id'];

        if ((int) $id !== 0) {
            return $companies->find($id);
        }

        return $companies->create($this->account, $values);
    }

    private function findOrCreateVisitor(VisitorRepository $visitors, Company $company, array $values)
    {
        $id = $values['id'];
        $values['company_id'] = $company->id();

        if ((int) $id !== 0) {
            return $visitors->find($id);
        }

        return $visitors->create($this->account, $values);
    }
}
