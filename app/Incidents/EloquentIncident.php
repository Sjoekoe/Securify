<?php
namespace App\Incidents;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EloquentIncident extends Model implements Incident
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['type', 'account_id', 'ended_at'];

    /**
     * @return int
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function endedAt()
    {
        return $this->ended_at ? Carbon::parse($this->ended_at) : null;
    }
}
