<?php
namespace App\Helpers;

use App\Accounts\Account;
use App\Companies\Company;
use App\Employees\Employee;
use App\Incidents\Incident;
use App\Items\Item;
use App\Keys\Key;
use App\Locations\Buildings\Building;
use App\Locations\Doors\Door;
use App\Patrols\Checkpoints\Checkpoint;
use App\Patrols\Patrol;
use App\Tasks\Task;
use App\Teams\Team;
use App\Users\User;
use App\Visitors\Visitor;
use App\Visits\Visit;
use Carbon\Carbon;

trait CreatesModels
{
    /**
     * @param array $attributes
     * @return \App\Users\User
     */
    public function createUser(array $attributes = [])
    {
        return $this->modelFactory->create(User::class, array_merge([
            'name' => 'Doe',
            'email' => 'john.doe@email.com',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Accounts\Account
     */
    public function createAccount(array $attributes = [])
    {
        return $this->modelFactory->create(Account::class, array_merge([
            'name' => 'Foo Company',
            'website' => 'www.test.com',
            'vat' => '123456',
            'date_format' => 'd-m-y',
            'time_format' => 'HH:MM',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Teams\Team
     */
    public function createTeam(array $attributes = [])
    {
        return $this->modelFactory->create(Team::class, array_merge([
            'user_id' => $this->createUser(['email' => 'second@user.com'])->id(),
            'account_id' => $this->createAccount()->id(),
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Employees\Employee
     */
    public function createEmployee(array $attributes = [])
    {
        return $this->modelFactory->create(Employee::class, array_merge([
            'name' => 'Employees name',
            'number' => '4567',
            'telephone' => '12345',
            'email' => 'employee@mail.com',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Companies\Company
     */
    public function createCompany(array $attributes = [])
    {
        return $this->modelFactory->create(Company::class, array_merge([
            'name' => 'Company Name',
            'telephone' => '345678',
            'website' => 'http://www.company.com',
            'email' => 'info@company.be',
            'vat' => '12345678',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Visitors\Visitor
     */
    public function createVisitor(array $attributes = [])
    {
        return $this->modelFactory->create(Visitor::class, array_merge([
            'name' => 'Visitors name',
        ], $attributes));
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $attributes
     * @return \App\Visits\Visit
     */
    public function createVisit(Account $account, array $attributes = [])
    {
        $now = Carbon::now();
        $later = Carbon::now()->addHour();

        $employee = $this->createEmployee([
            'account_id' => $account->id(),
        ]);
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);
        $visitor = $this->createVisitor([
            'account_id' => $account->id(),
            'company_id' => $company->id(),
        ]);

        return $this->modelFactory->create(Visit::class, array_merge([
            'account_id' => $account->id(),
            'employee_id' => $employee->id(),
            'visitor_id' => $visitor->id(),
            'expected_arrival' => $now,
            'expected_departure' => $later,
            'arrival' => $now,
            'departure' => $later,
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Keys\Key
     */
    public function createKey(array $attributes = [])
    {
        return $this->modelFactory->create(Key::class, array_merge([
            'number' => '1234',
            'key_code' => 'ab-34',
            'name' => 'First Key',
            'description' => 'Some description',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Incidents\Incident
     */
    public function createIncident(array $attributes = [])
    {
        $now = Carbon::now();

        return $this->modelFactory->create(Incident::class, array_merge([
            'type' => 1,
            'ended_at' => $now,
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Locations\Buildings\Building
     */
    public function createBuilding(array $attributes = [])
    {
        return $this->modelFactory->create(Building::class, array_merge([
            'name' => 'Foo building',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Locations\Doors\Door
     */
    public function createDoor(array $attributes = [])
    {
        return $this->modelFactory->create(Door::class, array_merge([
            'name' => 'Test Door',
            'description' => 'Lorem ipsum dolores est',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Patrols\Patrol
     */
    public function createPatrol(array $attributes = [])
    {
        return $this->modelFactory->create(Patrol::class, array_merge([
            'name' => 'Test Patrol',
            'description' => 'Lorem ipsum dolores est',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Patrols\Checkpoints\Checkpoint
     */
    public function createCheckpoint(array $attributes = [])
    {
        return $this->modelFactory->create(Checkpoint::class, array_merge([
            'name' => 'Test checkpoint',
            'description' => 'Test description',
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Tasks\Task
     */
    public function createTask(array $attributes = [])
    {
        $now = Carbon::now();

        return $this->modelFactory->create(Task::class, array_merge([
            'name' => 'Foo task',
            'description' => 'Lorem ipsum dolores est',
            'expected_start' => $now,
            'expected_end' => $now,
            'finished' => $now,
        ], $attributes));
    }

    /**
     * @param array $attributes
     * @return \App\Items\Item
     */
    public function createItem(array $attributes = [])
    {
        return $this->modelFactory->create(Item::class, array_merge([
            'name' => 'Foo Item',
            'description' => 'Lorem ipsum dolores est',
            'code' => 'ARF-4',
        ], $attributes));
    }
}
