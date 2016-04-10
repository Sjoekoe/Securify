<?php
namespace App\Users;

interface UserRepository
{
    /**
     * @param array $values
     * @return \App\Users\User
     */
    public function create(array $values);

    /**
     * @param \App\Users\User $user
     * @param array $values
     * @return \App\Users\User
     */
    public function update(User $user, array $values);

    /**
     * @param \App\Users\User $user
     */
    public function delete(User $user);

    public function findAllPaginated($limit = 10);

    /**
     * @param int $id
     * @return \App\Users\User
     */
    public function find($id);
}
