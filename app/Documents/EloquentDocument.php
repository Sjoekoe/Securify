<?php
namespace App\Documents;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentDocument extends Model implements Document
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
