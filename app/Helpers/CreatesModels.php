<?php
namespace App\Helpers;

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
}
