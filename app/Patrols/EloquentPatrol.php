<?php
namespace App\Patrols;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentPatrol extends Model implements Patrol
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
}
