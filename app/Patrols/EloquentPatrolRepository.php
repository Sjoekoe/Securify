<?php
namespace App\Patrols;

use App\Accounts\Account;

class EloquentPatrolRepository implements PatrolRepository
{
    /**
     * @var \App\Patrols\EloquentPatrol
     */
    private $patrol;

    public function __construct(EloquentPatrol $patrol)
    {
        $this->patrol = $patrol;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Patrols\Patrol
     */
    public function create(Account $account, array $values)
    {
        $patrol = new EloquentPatrol($values);
        $patrol->account_id = $account->id();

        $patrol->save();

        return $patrol;
    }

    /**
     * @param \App\Patrols\Patrol $patrol
     * @param array $values
     * @return \App\Patrols\Patrol
     */
    public function update(Patrol $patrol, array $values)
    {
        if (array_key_exists('name', $values)) {
            $patrol->name = $values['name'];
        }

        if (array_key_exists('description', $values)) {
            $patrol->description = $values['description'];
        }

        $patrol->save();

        return $patrol;
    }

    /**
     * @param \App\Patrols\Patrol $patrol
     */
    public function delete(Patrol $patrol)
    {
        $patrol->delete();
    }

    /**
     * @param int $id
     * @return \App\Patrols\Patrol|null
     */
    public function find($id)
    {
        return $this->patrol->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->patrol
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
