<?php
namespace App\Helpers;

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
}
