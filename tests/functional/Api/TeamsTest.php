<?php
namespace functional\Api;

use App\Helpers\DefaultIncludes;
use App\Teams\Team;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamsTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_teams_for_a_user()
    {
        $user = $this->createUser();
        $team = $this->createTeam([
            'user_id' => $user->id()
        ]);

        $this->get('/api/users/' . $user->id() . '/teams')
            ->seeJsonEquals([
                'data' => [
                    $this->includedTeam($team),
                ],
                'meta' => [
                    'pagination' => [
                        'count' => 1,
                        'current_page' => 1,
                        'links' => [],
                        'per_page' => 10,
                        'total' => 1,
                        'total_pages' => 1,
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_a_team()
    {
        $user = $this->createUser();
        $team = $this->createTeam([
            'user_id' => $user->id(),
        ]);

        $this->get('/api/users/' . $user->id() . '/teams/' . $team->id())
            ->seeJsonEquals([
                'data' => $this->includedTeam($team),
            ]);
    }

    /** @test */
    function it_can_delete_a_team()
    {
        $user = $this->createUser();
        $team = $this->createTeam([
            'user_id' => $user->id(),
        ]);

        $this->seeInDatabase(Team::TABLE, [
            'id' => $team->id(),
        ]);

        $this->delete('/api/users/' . $user->id() . '/teams/' . $team->id())
            ->assertNoContent();

        $this->missingFromDatabase(Team::TABLE, [
            'id' => $team->id(),
        ]);
    }
}
