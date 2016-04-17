<?php
namespace App\Auth;

use App\Teams\Team;
use Illuminate\Auth\SessionGuard;

final class Guard extends SessionGuard
{
    /**
     * @var \App\Auth\UserProviderInterface
     */
    protected $provider;

    /**
     * @var \App\Teams\Team
     */
    protected $team;

    /**
     * @return \App\Users\User|null
     */
    public function user()
    {
        return parent::user();
    }

    public function logout()
    {
        $this->clearTeamDataFromStorage();

        parent::logout();

        $this->team = null;
    }

    /**
     * @param \App\Teams\Team $team
     * @param bool $remember
     */
    public function loginTeam(Team $team, $remember = false)
    {
        $this->login($team->user(), $remember);

        $this->activateTeam($team);
    }

    /**
     * @param \App\Teams\Team $team
     */
    public function activateTeam(Team $team)
    {
        $this->updateTeamSession($team->id());

        $this->team = $team;
    }

    /**
     * @param \App\Teams\Team $team
     */
    public function updateLastTeamLogin(Team $team)
    {
        $this->provider->updateLastTeamLogin($team);
    }

    /**
     * @return bool
     */
    public function checkTeam()
    {
        return ! is_null($this->team());
    }

    /**
     * @return \App\Teams\Team|null
     */
    public function team()
    {
        if ($this->guest()) {
            return null;
        }

        if (! is_null($this->team)) {
            return $this->team;
        }

        $id = $this->session->get($this->getTeamSessionName());
        $team = null;

        if (! is_null($id)) {
            $team = $this->provider->retrieveTeamById($id);
        }

        return $this->team = $team;
    }

    /**
     * @return \App\Accounts\Account|null
     */
    public function account()
    {
        if (! $this->checkTeam()) {
            return null;
        }

        return $this->team()->account();
    }

    /**
     * @param \App\Teams\Team $team
     */
    public function beTeam(Team $team)
    {
        $this->team = $team;

        $this->setUser($team->user());
    }

    /**
     * @param int $id
     */
    protected function updateTeamSession($id)
    {
        $this->session->put($this->getTeamSessionName(), $id);

        $this->session->migrate(true);
    }

    protected function clearTeamDataFromStorage()
    {
        $this->session->forget($this->getTeamSessionName());
    }

    /**
     * @return string
     */
    protected function getTeamSessionName()
    {
        return 'active_team_' . md5(get_class($this));
    }

    public function logoutCurrentTeam()
    {
        $this->clearTeamDataFromStorage();

        $this->team = null;
    }
}
