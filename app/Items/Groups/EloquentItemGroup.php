<?php
namespace App\Items\Groups;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentItemGroup extends Model implements ItemGroup
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
