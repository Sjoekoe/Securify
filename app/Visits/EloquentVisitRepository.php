<?php
namespace App\Visits;

use App\Accounts\Account;
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
     * @param \App\Visits\Visit $visit
     * @param array $values
     * @return \App\Visits\Visit
     */
    public function update(Visit $visit, array $values)
    {
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
