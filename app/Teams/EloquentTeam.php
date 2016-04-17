<?php
namespace App\Teams;

use App\Accounts\EloquentAccount;
use App\Helpers\StandardModel;
use App\Users\EloquentUser;
use Illuminate\Database\Eloquent\Model;

class EloquentTeam extends Model implements Team
{
    use StandardModel;

    /**
     * @var string
     */
    protected $table = self::TABLE;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountRelation()
    {
        return $this->belongsTo(EloquentAccount::class, 'account_id', 'id');
    }

    /**
     * @return \App\Accounts\Account
     */
    public function account()
    {
        return $this->accountRelation()->first();
    }
}
