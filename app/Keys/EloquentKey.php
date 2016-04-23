<?php
namespace App\Keys;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentKey extends Model implements Key
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table= self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['number', 'name', 'key_code', 'description'];

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
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function keyCode()
    {
        return $this->key_code;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }
}
