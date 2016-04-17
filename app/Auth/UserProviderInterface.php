<?php
namespace App\Auth;

use App\Teams\Team;
use Illuminate\Contracts\Auth\UserProvider;

interface UserProviderInterface extends UserProvider
{
    /**
     * @param int $identifier
     * @return \App\Teams\Team
     */
    public function retrieveTeamById($identifier);

    /**
     * @param \App\Teams\Team $team
     */
    public function updateLastTeamLogin(Team $team);
}
