<?php
namespace App\Visits;

use App\Employees\EloquentEmployee;
use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use App\Visitors\EloquentVisitor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EloquentVisit extends Model implements Visit
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['expected_arrival', 'expected_departure', 'arrival', 'departure'];

    /**
     * @return \Carbon\Carbon
     */
    public function expectedArrival()
    {
        return Carbon::parse($this->expected_arrival);
    }

    /**
     * @return \Carbon\Carbon
     */
    public function expectedDeparture()
    {
        return Carbon::parse($this->expected_departure);
    }

    /**
     * @return \Carbon\Carbon
     */
    public function arrival()
    {
        return Carbon::parse($this->arrival);
    }

    /**
     * @return \Carbon\Carbon
     */
    public function departure()
    {
        return Carbon::parse($this->departure);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitorRelation()
    {
        return $this->belongsTo(EloquentVisitor::class, 'visitor_id', 'id');
    }

    /**
     * @return \App\Visitors\Visitor
     */
    public function visitor()
    {
        return $this->visitorRelation()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employeeRelation()
    {
        return $this->belongsTo(EloquentEmployee::class, 'employee_id', 'id');
    }

    /**
     * @return \App\Employees\Employee
     */
    public function employee()
    {
        return $this->employeeRelation()->first();
    }
}
