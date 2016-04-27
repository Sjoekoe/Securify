<?php
namespace App\Api\Http\Controllers\Accounts\Patrols\CheckPoints;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Patrols\Checkpoints\CheckpointTransformer;
use App\Api\Patrols\Checkpoints\Requests\StoreCheckpointRequest;
use App\Api\Patrols\Checkpoints\Requests\UpdateCheckpointRequest;
use App\Patrols\Checkpoints\Checkpoint;
use App\Patrols\Checkpoints\CheckpointCreator;
use App\Patrols\Checkpoints\CheckpointRepository;
use App\Patrols\Patrol;

class CheckpointController extends Controller
{
    /**
     * @var \App\Patrols\Checkpoints\CheckpointRepository
     */
    private $checkpoints;

    public function __construct(CheckpointRepository $checkpoints)
    {
        $this->checkpoints = $checkpoints;
    }

    public function index(Account $account, Patrol $patrol)
    {
        $checkpoints = $this->checkpoints->findByPatrolPaginated($patrol);

        return $this->response()->paginator($checkpoints, new CheckpointTransformer());
    }

    public function store(StoreCheckpointRequest $request, CheckpointCreator $creator, Account $account, Patrol $patrol)
    {
        $checkpoint = $creator->create($account, $patrol, $request->all());

        return $this->response()->item($checkpoint, new CheckpointTransformer());
    }

    public function show(Account $account, Patrol $patrol, Checkpoint $checkpoint)
    {
        return $this->response()->item($checkpoint, new CheckpointTransformer());
    }

    public function update(UpdateCheckpointRequest $request, Account $account, Patrol $patrol, Checkpoint $checkpoint)
    {
        $checkpoint = $this->checkpoints->update($checkpoint, $request->all());

        return $this->response()->item($checkpoint, new CheckpointTransformer());
    }

    public function delete(Account $account, Patrol $patrol, Checkpoint $checkpoint)
    {
        $this->checkpoints->delete($checkpoint);

        return $this->response()->noContent();
    }
}
