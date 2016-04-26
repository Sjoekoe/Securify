<?php
namespace App\Api\Http\Controllers\Accounts\Patrols;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Patrols\PatrolTransformer;
use App\Api\Patrols\Requests\StorePatrolRequest;
use App\Patrols\Patrol;
use App\Patrols\PatrolRepository;

class PatrolController extends Controller
{
    /**
     * @var \App\Patrols\PatrolRepository
     */
    private $patrols;

    public function __construct(PatrolRepository $patrols)
    {
        $this->patrols = $patrols;
    }

    public function index(Account $account)
    {
        $patrols = $this->patrols->findByAccountPaginated($account);

        return $this->response()->paginator($patrols, new PatrolTransformer());
    }

    public function store(StorePatrolRequest $request, Account $account)
    {
        $patrol = $this->patrols->create($account, $request->all());

        return $this->response()->item($patrol, new PatrolTransformer());
    }

    public function show(Account $account, Patrol $patrol)
    {
        return $this->response()->item($patrol, new PatrolTransformer());
    }

    public function update(StorePatrolRequest $request, Account $account, Patrol $patrol)
    {
        $patrol = $this->patrols->update($patrol, $request->all());

        return $this->response()->item($patrol, new PatrolTransformer());
    }

    public function delete(Account $account, Patrol $patrol)
    {
        $this->patrols->delete($patrol);

        return $this->response()->noContent();
    }
}
