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
use App\Visits\Visit;
use App\Visits\VisitRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateVisitation extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, CanMakeDatabaseTransactions;

    /**
     * @var \App\Visits\Visit
     */
    private $visit;

    /**
     * @var array
     */
    private $values;

    /**
     * @var \App\Accounts\Account
     */
    private $account;

    public function __construct(Account $account, Visit $visit, array $values)
    {
        $this->transactionManager = app(TransactionManager::class);
        $this->account = $account;
        $this->visit = $visit;
        $this->values = $values;
    }

    /**
     * @param \App\Employees\EmployeeRepository $employees
     * @param \App\Companies\CompanyRepository $companies
     * @param \App\Visitors\VisitorRepository $visitors
     * @param \App\Visits\VisitRepository $visits
     */
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

            $values = $this->values;
            $values['compny_id'] = $company->id();
            $values['employee_id'] = $employee->id();
            $values['visitor_id'] = $visitor->id();

            $visit = $visits->update($this->visit, $values);

            return $visit;
        });
    }

    /**
     * @param \App\Companies\CompanyRepository $companies
     * @param array $values
     * @return \App\Companies\Company|null
     */
    private function findOrCreateCompany(CompanyRepository $companies, array $values)
    {
        $id = $values['id'];

        if ((int) $id !== 0) {
            return $companies->find($id);
        }

        return $companies->create($this->account, $values);
    }

    /**
     * @param \App\Visitors\VisitorRepository $visitors
     * @param \App\Companies\Company $company
     * @param array $values
     * @return \App\Visitors\Visitor|null
     */
    private function findOrCreateVisitor(VisitorRepository $visitors, Company $company, array $values)
    {
        $id = $values['id'];
        $values['company_id'] = $company->id();

        if ((int) $id !== 0) {
            $visitor = $visitors->find($id);
            
            if ($visitor->company()->id() !== $company->id()) {
                $visitor = $visitors->update($visitor, $values);
            }

            return $visitor;
        }

        return $visitors->create($this->account, $values);
    }
}
