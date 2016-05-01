<?php

use App\Accounts\EloquentAccount;
use App\Companies\EloquentCompany;
use App\Documents\EloquentDocument;
use App\Employees\EloquentEmployee;
use App\Incidents\EloquentIncident;
use App\Items\EloquentItem;
use App\Items\Groups\EloquentItemGroup;
use App\Keys\EloquentKey;
use App\Locations\Buildings\EloquentBuilding;
use App\Locations\Doors\EloquentDoor;
use App\Patrols\Checkpoints\EloquentCheckpoint;
use App\Patrols\EloquentPatrol;
use App\Tasks\EloquentTask;
use App\Teams\EloquentTeam;
use App\Transports\EloquentTransport;
use App\Users\EloquentUser;
use App\Vehicles\EloquentVehicle;
use App\Visitors\EloquentVisitor;
use App\Visits\EloquentVisit;
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
$factory->define(EloquentVisit::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentKey::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentIncident::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentBuilding::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentDoor::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentPatrol::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentCheckpoint::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentTask::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentItem::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentItemGroup::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentVehicle::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentTransport::class, function (Generator $faker) {
    return [];
});
$factory->define(EloquentDocument::class, function (Generator $faker) {
    return [];
});
