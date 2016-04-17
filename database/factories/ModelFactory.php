<?php

use App\Accounts\EloquentAccount;
use App\Companies\EloquentCompany;
use App\Employees\EloquentEmployee;
use App\Teams\EloquentTeam;
use App\Users\EloquentUser;
use App\Visitors\EloquentVisitor;
use Faker\Generator;

$factory->define(EloquentUser::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentAccount::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentTeam::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentEmployee::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentVisitor::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentCompany::class, function (Generator $faker) {
    return [];
});
