<?php
namespace App\Items;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentItem extends Model implements Item
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'code'];

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
     * @return string
     */
    public function code()
    {
        return $this->code;
    }
}
