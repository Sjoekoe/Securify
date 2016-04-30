<?php
namespace App\Transports;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use App\Vehicles\EloquentVehicle;
use Illuminate\Database\Eloquent\Model;

class EloquentTransport extends Model implements Transport
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['product', 'number'];

    /**
     * @return string
     */
    public function product()
    {
        return $this->product;
    }

    /**
     * @return string
     */
    public function number()
    {
        return $this->number;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicleRelation()
    {
        return $this->belongsTo(EloquentVehicle::class, 'vehicle_id', 'id');
    }

    /**
     * @return \App\Vehicles\Vehicle
     */
    public function vehicle()
    {
        return $this->vehicleRelation()->first();
    }
}
