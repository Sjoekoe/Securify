<?php
namespace App\Locations\Doors;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use App\Keys\EloquentKey;
use App\Locations\Buildings\EloquentBuilding;
use Illuminate\Database\Eloquent\Model;

class EloquentDoor extends Model implements Door
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'building_id', 'account_id', 'key_id'];

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
    public function buildingRelation()
    {
        return $this->belongsTo(EloquentBuilding::class, 'building_id', 'id');
    }

    /**
     * @return \App\Locations\Buildings\Building
     */
    public function building()
    {
        return $this->buildingRelation()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function keyRelation()
    {
        return $this->belongsTo(EloquentKey::class, 'key_id', 'id');
    }

    /**
     * @return \App\Keys\Key
     */
    public function key()
    {
        return $this->keyRelation()->first();
    }
}
