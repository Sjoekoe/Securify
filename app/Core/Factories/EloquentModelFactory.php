<?php
namespace App\Core\Factories;

use App\Accounts\Account;
use App\Accounts\EloquentAccount;
use App\Teams\EloquentTeam;
use App\Teams\Team;
use App\Users\EloquentUser;
use App\Users\User;
use Illuminate\Database\Eloquent\Factory;

class EloquentModelFactory
{
    /**
     * @var \Illuminate\Database\Eloquent\Factory
     */
    private $factory;

    /**
     * @var array
     */
    private $models = [
        Account::class => EloquentAccount::class,
        Team::class => EloquentTeam::class,
        User::class => EloquentUser::class,
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $model
     * @param array $attributes
     * @return object
     */
    public function make($model, array $attributes = [])
    {
        return $this->factory->of($this->resolveModel($model))->make($attributes);
    }

    /**
     * @param string $model
     * @param array $attributes
     * @param int $times
     * @return object
     */
    public function create($model, array $attributes = [], $times = 1)
    {
        return $this->factory->of($this->resolveModel($model))->times($times)->create($attributes);
    }

    /**
     * @param string $model
     */
    private function resolveModel($model)
    {
        if (! isset($this->models[$model])) {
            throw InvalidModelException::notRegistered($model);
        }

        return $this->models[$model];
    }
}
