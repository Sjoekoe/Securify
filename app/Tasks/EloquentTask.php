<?php
namespace App\Tasks;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EloquentTask extends Model implements Task
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'expected_start', 'expected_end', 'finished'];

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
     * @return \Carbon\Carbon
     */
    public function expectedStart()
    {
        return Carbon::parse($this->expected_start);
    }

    /**
     * @return \Carbon\Carbon
     */
    public function expectedEnd()
    {
        return Carbon::parse($this->expected_end);
    }

    /**
     * @return \Carbon\Carbon
     */
    public function finished()
    {
        return $this->finished ? Carbon::parse($this->finished) : null;
    }
}
