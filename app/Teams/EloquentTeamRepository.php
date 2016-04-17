<?php
namespace App\Teams;

use App\Accounts\Account;
use App\Users\User;

class EloquentTeamRepository implements TeamRepository
{
    /**
     * @var \App\Teams\EloquentTeam
     */
    private $team;

    public function __construct(EloquentTeam $team)
    {
        $this->team = $team;
    }

    /**
     * @param \App\Teams\Team $team
     */
    public function delete(Team $team)
    {
        $team->delete();
    }

    /**
     * @param \App\Users\User $user
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByUsersPaginated(User $user, $limit = 10)
    {
        return $this->team->where('user_id', $user->id())->paginate($limit);
    }

    /**
     * @param int $id
     * @return \App\Teams\Team|null
     */
    public function find($id)
    {
        return $this->team->where('id', $id)->first();
    }

    /**
     * @param \App\Users\User $user
     * @param \App\Accounts\Account $account
     * @return \App\Teams\Team
     */
    public function findByUserAndAccount(User $user, Account $account)
    {
        return $this->team
            ->where('user_id', $user->id())
            ->where('account_id', $account->id())
            ->first();
    }
}
