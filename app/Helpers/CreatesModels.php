<?php
namespace App\Helpers;

use App\Accounts\Account;
use App\Teams\Team;
use App\Users\User;

trait CreatesModels
{
    /**
     * @param array $attributes
     * @return \App\Users\User
     */
    public function createUser(array $attributes = [])
    {
        return $this->modelFactory->create(User::class, array_merge([
            'name' => 'Doe',
            'email' => 'john.doe@email.com',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Accounts\Account
     */
    public function createAccount(array $attributes = [])
    {
        return $this->modelFactory->create(Account::class, array_merge([
            'name' => 'Foo Company',
            'website' => 'www.test.com',
            'vat' => '123456',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Teams\Team
     */
    public function createTeam(array $attributes = [])
    {
        return $this->modelFactory->create(Team::class, array_merge([
            'user_id' => $this->createUser(['email' => 'second@user.com'])->id(),
            'account_id' => $this->createAccount()->id(),
        ], $attributes));
    }
}
