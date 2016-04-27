<?php
namespace App\Patrols\Checkpoints;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class CheckpointRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Patrols\Checkpoints\CheckpointRepository
     */
    private $checkpoints;

    public function __construct(CheckpointRepository $checkpoints)
    {
        $this->checkpoints = $checkpoints;
    }

    /**
     * @param int $id
     * @return \App\Patrols\Checkpoints\Checkpoint|null
     */
    public function find($id)
    {
        return $this->checkpoints->find($id);
    }
}
