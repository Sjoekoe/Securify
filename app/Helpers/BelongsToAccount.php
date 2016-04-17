<?php
namespace App\Helpers;

use App\Accounts\EloquentAccount;

trait BelongsToAccount
{
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
