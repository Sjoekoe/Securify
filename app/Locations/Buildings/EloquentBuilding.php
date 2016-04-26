<?php
namespace App\Locations\Buildings;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentBuilding extends Model implements Building
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}
