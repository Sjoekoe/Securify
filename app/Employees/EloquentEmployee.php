<?php
namespace App\Employees;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentEmployee extends Model implements Employee
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    protected $fillable = ['name', 'telephone', 'email', 'number', 'account_id'];

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
    public function number()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function telephone()
    {
        return $this->telephone;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }
}
