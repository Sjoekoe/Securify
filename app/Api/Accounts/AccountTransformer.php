<?php
namespace App\Api\Accounts;

use App\Accounts\Account;
use League\Fractal\TransformerAbstract;

class AccountTransformer extends TransformerAbstract
{
    /**
     * @param \App\Accounts\Account $account
     * @return array
     */
    public function transform(Account $account)
    {
        return [
            'id' => $account->id(),
            'name' => $account->name(),
            'website' => $account->website(),
            'vat' => $account->vat(),
            'created_at' => $account->createdAt()->toIso8601String(),
            'updated_at' => $account->updatedAt()->toIso8601String(),
        ];
    }
}
