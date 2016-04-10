<?php
namespace App\Users;

class EloquentUserRepository implements UserRepository
{
    /**
     * @var \App\Users\EloquentUser
     */
    private $user;

    public function __construct(EloquentUser $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $values
     * @return \App\Users\User
     */
    public function create(array $values)
    {
        $user = new EloquentUser();
        $user->name = $values['name'];
        $user->email = $values['email'];

        $user->save();

        return $user;
    }

    /**
     * @param \App\Users\User $user
     * @param array $values
     * @return \App\Users\User
     */
    public function update(User $user, array $values)
    {
        if (array_key_exists('name', $values)) {
            $user->name = $values['name'];
        }

        if (array_key_exists('email', $values)) {
            $user->email = $values['email'];
        }

        $user->save();

        return $user;
    }

    /**
     * @param \App\Users\User $user
     */
    public function delete(User $user)
    {
        $user->delete();
    }

    public function findAllPaginated($limit = 10)
    {
        return $this->user->paginate($limit);
    }

    /**
     * @param int $id
     * @return \App\Users\User
     */
    public function find($id)
    {
        return $this->user->where('id', $id)->first();
    }
}
