<?php
namespace App\Visitors;

use App\Employees\EloquentEmployee;
use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentVisitor extends Model implements Visitor
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;
    
    protected $fillable = ['name'];

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
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
