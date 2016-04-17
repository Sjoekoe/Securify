<?php
namespace App\Visitors;

use App\Companies\EloquentCompany;
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
    public function companyRelation()
    {
        return $this->belongsTo(EloquentCompany::class, 'company_id', 'id');
    }

    /**
     * @return \App\Employees\Employee
     */
    public function company()
    {
        return $this->companyRelation()->first();
    }
}
