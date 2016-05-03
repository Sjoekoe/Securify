<?php
namespace App\Todos;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use App\Users\EloquentUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EloquentTodo extends Model implements Todo
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['name', 'date', 'finished'];

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function date()
    {
        return Carbon::parse($this->date);
    }

    /**
     * @return bool
     */
    public function finished()
    {
        return $this->finished;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRelation()
    {
        return $this->belongsTo(EloquentUser::class, 'user_id', 'id');
    }

    /**
     * @return \App\Users\User
     */
    public function user()
    {
        return $this->userRelation()->first();
    }
}
