<?php
namespace App\Api\Http\Controllers\Teams;

use App\Api\Http\Controller;
use App\Api\Teams\TeamTransformer;
use App\Teams\Team;
use App\Teams\TeamRepository;
use App\Users\User;

class TeamController extends Controller
{
    /**
     * @var \App\Teams\TeamRepository
     */
    private $teams;

    public function __construct(TeamRepository $teams)
    {
        $this->teams = $teams;
    }

    public function index(User $user)
    {
        $teams = $this->teams->findByUsersPaginated($user);

        return $this->response()->paginator($teams, new TeamTransformer());
    }

    public function show(User $user, Team $team)
    {
        return $this->response()->item($team, new TeamTransformer());
    }

    public function delete(User $user, Team $team)
    {
        $this->teams->delete($team);

        return $this->response()->noContent();
    }
}
