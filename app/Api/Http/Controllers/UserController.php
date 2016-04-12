<?php
namespace App\Api\Http\Controllers;

use App\Api\Users\Requests\StoreUserRequest;
use App\Api\Http\Controller;
use App\Api\Users\Requests\UpdateUserRequest;
use App\Api\Users\UserTransformer;
use App\Users\User;
use App\Users\UserRepository;

class UserController extends Controller
{
    /**
     * @var \App\Users\UserRepository
     */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->findAllPaginated();

        return $this->response()->paginator($users, new UserTransformer());
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->users->create($request->all());

        if (auth()->attempt(['email' => $request->get('email'), 'password' => $request->get('password')], false)) {
            dd('authenticated');
        };

        return $this->response()->item($user, new UserTransformer());
    }

    public function show(User $user)
    {
        return $this->response()->item($user, new UserTransformer());
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->users->update($user, $request->all());

        return $this->response()->item($user, new UserTransformer());
    }

    public function delete(User $user)
    {
        $this->users->delete($user);

        return $this->response()->noContent();
    }
}
