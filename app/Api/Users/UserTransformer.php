<?php
namespace App\Api\Users;

use App\Users\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id(),
            'name' => $user->name(),
            'email' => $user->email(),
            'created_at' => $user->createdAt()->toIso8601String(),
            'updated_at' => $user->updatedAt()->toIso8601String(),
        ];
    }
}
