<?php
namespace App\Teams;

use App\Users\User;

interface TeamRepository
{
    /**
     * @param \App\Teams\Team $team
     */
    public function delete(Team $team);
    
    /**
     * @param \App\Users\User $user
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByUsersPaginated(User $user, $limit = 10);

    /**
     * @param int $id
     * @return \App\Teams\Team|null
     */
    public function find($id);
}
