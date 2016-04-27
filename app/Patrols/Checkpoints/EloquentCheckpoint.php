<?php
namespace App\Patrols\Checkpoints;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use App\Locations\Doors\EloquentDoor;
use App\Patrols\EloquentPatrol;
use Illuminate\Database\Eloquent\Model;

class EloquentCheckpoint extends Model implements Checkpoint
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patrolRelation()
    {
        return $this->belongsTo(EloquentPatrol::class, 'patrol_id', 'id');
    }

    /**
     * @return \App\Patrols\Patrol
     */
    public function patrol()
    {
        return $this->patrolRelation()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doorRelation()
    {
        return $this->belongsTo(EloquentDoor::class, 'door_id', 'id');
    }

    /**
     * @return \App\Locations\Doors\Door
     */
    public function door()
    {
        return $this->doorRelation()->first();
    }
}
