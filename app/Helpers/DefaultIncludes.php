<?php
namespace App\Helpers;

use App\Accounts\Account;
use App\Users\User;

trait DefaultIncludes
{
    /**
     * @param \App\Users\User $user
     * @param array $attributes
     * @return array
     */
    public function includedUser(User $user, $attributes = [])
    {
        return array_merge([
            'id' => $user->id(),
            'name' => $user->name(),
            'email' => $user->email(),
            'created_at' => $user->createdAt()->toIso8601String(),
            'updated_at' => $user->updatedAt()->toIso8601String(), 
        ], $attributes);
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $attributes
     * @return array
     */
    public function includedAccount(Account $account, $attributes = [])
    {
        return array_merge([
            'id' => $account->id(),
            'name' => $account->name(),
            'website' => $account->website(),
            'vat' => $account->vat(),
            'created_at' => $account->createdAt()->toIso8601String(),
            'updated_at' => $account->updatedAt()->toIso8601String(),
        ], $attributes);
    }
}
