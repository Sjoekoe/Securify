<?php
namespace App\Visits;

use App\Accounts\Account;
use App\Companies\Company;
use App\Employees\Employee;
use App\Visitors\Visitor;
use Carbon\Carbon;

class EloquentVisitRepository implements VisitRepository
{
    /**
     * @var \App\Visits\EloquentVisit
     */
    private $visit;

    public function __construct(EloquentVisit $visit)
    {
        $this->visit = $visit;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param \App\Employees\Employee $employee
     * @param \App\Visitors\Visitor $visitor
     * @param array $values
     * @return \App\Visits\Visit
     */
    public function create(Account $account, Employee $employee, Visitor $visitor, array $values)
    {
        $visit = new EloquentVisit();
        $visit->account_id = $account->id();
        $visit->employee_id = $employee->id();
        $visit->visitor_id = $visitor->id();
        $visit->expected_arrival = Carbon::createFromFormat('d-m-Y - H:i', $values['expected_arrival']);
        $visit->expected_departure = Carbon::createFromFormat('d-m-Y - H:i', $values['expected_departure']);

        $visit->save();

        return $visit;
    }

    /**
     * @param \App\Visits\Visit $visit
     * @param array $values
     * @return \App\Visits\Visit
     */
    public function update(Visit $visit, array $values)
    {
        if (array_key_exists('expected_arrival', $values)) {
            $this->expected_arrival = Carbon::createFromFormat('d-m-Y - H:i', $values['expected_arrival']);
        }

        if (array_key_exists('expected_departure', $values)) {
            $this->expected_departure = Carbon::createFromFormat('d-m-Y - H:i', $values['expected_departure']);
        }

        $visit->employee_id = $values['employee_id'];
        $visit->visitor_id = $values['visitor_id'];

        if (array_key_exists('arrival', $values)) {
            $visit->arrival = Carbon::createFromFormat('d/m/Y', $values['arrival']);
        }

        if (array_key_exists('departure', $values)) {
            $visit->departure = Carbon::createFromFormat('d/m/Y', $values['departure']);
        }

        $visit->save();

        return $visit;
    }

    /**
     * @param \App\Visits\Visit $visit
     */
    public function delete(Visit $visit)
    {
        $visit->delete();
    }

    /**
     * @param int $id
     * @return \App\Visits\Visit|null
     */
    public function find($id)
    {
        return $this->visit->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->visit->where('account_id', $account->id())->paginate($limit);
    }
}
