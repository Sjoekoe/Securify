<?php
namespace App\Core\Factories;

use App\Accounts\Account;
use App\Accounts\EloquentAccount;
use App\Companies\Company;
use App\Companies\EloquentCompany;
use App\Documents\Document;
use App\Documents\EloquentDocument;
use App\Documents\Folders\EloquentFolder;
use App\Documents\Folders\Folder;
use App\Employees\EloquentEmployee;
use App\Employees\Employee;
use App\Incidents\EloquentIncident;
use App\Incidents\Incident;
use App\Items\EloquentItem;
use App\Items\Groups\EloquentItemGroup;
use App\Items\Groups\ItemGroup;
use App\Items\Item;
use App\Keys\EloquentKey;
use App\Keys\Key;
use App\Locations\Buildings\Building;
use App\Locations\Buildings\EloquentBuilding;
use App\Locations\Doors\Door;
use App\Locations\Doors\EloquentDoor;
use App\Patrols\Checkpoints\Checkpoint;
use App\Patrols\Checkpoints\EloquentCheckpoint;
use App\Patrols\EloquentPatrol;
use App\Patrols\Patrol;
use App\Tasks\EloquentTask;
use App\Tasks\Task;
use App\Teams\EloquentTeam;
use App\Teams\Team;
use App\Transports\EloquentTransport;
use App\Transports\Transport;
use App\Users\EloquentUser;
use App\Users\User;
use App\Vehicles\EloquentVehicle;
use App\Vehicles\Vehicle;
use App\Visitors\EloquentVisitor;
use App\Visitors\Visitor;
use App\Visits\EloquentVisit;
use App\Visits\Visit;
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
        Building::class => EloquentBuilding::class,
        Checkpoint::class => EloquentCheckpoint::class,
        Company::class => EloquentCompany::class,
        Document::class => EloquentDocument::class,
        Door::class => EloquentDoor::class,
        Employee::class => EloquentEmployee::class,
        Folder::class => EloquentFolder::class,
        Incident::class => EloquentIncident::class,
        Item::class => EloquentItem::class,
        ItemGroup::class => EloquentItemGroup::class,
        Key::class => EloquentKey::class,
        Patrol::class => EloquentPatrol::class,
        Task::class => EloquentTask::class,
        Team::class => EloquentTeam::class,
        Transport::class => EloquentTransport::class,
        User::class => EloquentUser::class,
        Vehicle::class => EloquentVehicle::class,
        Visit::class => EloquentVisit::class,
        Visitor::class => EloquentVisitor::class,
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
