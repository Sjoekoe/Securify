<?php
namespace App\Visits;

use App\Accounts\Account;

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
