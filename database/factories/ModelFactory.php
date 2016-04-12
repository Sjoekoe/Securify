<?php

use App\Accounts\EloquentAccount;
use App\Users\EloquentUser;
use Faker\Generator;

$factory->define(EloquentUser::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentAccount::class, function (Generator $faker) {
    return [];
});
