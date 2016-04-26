<?php
namespace App\Helpers;

use App\Accounts\Account;
use App\Companies\Company;
use App\Employees\Employee;
use App\Incidents\Incident;
use App\Keys\Key;
use App\Locations\Buildings\Building;
use App\Teams\Team;
use App\Users\User;
use App\Visitors\Visitor;
use App\Visits\Visit;

trait DefaultIncludes
{
    /**
     * @param \App\Users\User $user
     * @param array $attributes
     * @return array
     */
    public function includedUser(User $user, $attributes = [])
    {
        return array_merge([
            'id' => $user->id(),
            'name' => $user->name(),
            'email' => $user->email(),
            'created_at' => $user->createdAt()->toIso8601String(),
            'updated_at' => $user->updatedAt()->toIso8601String(),
        ], $attributes);
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $attributes
     * @return array
     */
    public function includedAccount(Account $account, $attributes = [])
    {
        return array_merge([
            'id' => $account->id(),
            'name' => $account->name(),
            'website' => $account->website(),
            'vat' => $account->vat(),
            'date_format' => $account->dateFormat(),
            'time_format' => $account->timeFormat(),
            'created_at' => $account->createdAt()->toIso8601String(),
            'updated_at' => $account->updatedAt()->toIso8601String(),
        ], $attributes);
    }

    /**
     * @param \App\Teams\Team $team
     * @param array $attributes
     * @return array
     */
    public function includedTeam(Team $team, $attributes = [])
    {
        return array_merge([
            'id' => $team->id(),
            'userRelation' => [
                'data' => $this->includedUser($team->user()),
            ],
            'accountRelation' => [
                'data' => $this->includedAccount($team->account()),
            ],
        ], $attributes);
    }

    /**
     * @param \App\Employees\Employee $employee
     * @param array $attributes
     * @return array
     */
    public function includedEmployee(Employee $employee, $attributes = [])
    {
        return array_merge([
            'id' => $employee->id(),
            'name' => $employee->name(),
            'email' => $employee->email(),
            'number' => $employee->number(),
            'telephone' => $employee->telephone(),
            'accountRelation' => [
                'data' => $this->includedAccount($employee->account()),
            ]
        ], $attributes);
    }

    /**
     * @param \App\Visitors\Visitor $visitor
     * @param array $attributes
     * @return array
     */
    public function includedVisitor(Visitor $visitor, $attributes = [])
    {
        return array_merge([
            'id' => $visitor->id(),
            'name' => $visitor->name(),
            'accountRelation' => [
                'data' => $this->includedAccount($visitor->account()),
            ],
            'companyRelation' => [
                'data' => $this->includedCompany($visitor->company()),
            ]
        ], $attributes);
    }

    /**
     * @param \App\Companies\Company $company
     * @param array $attributes
     * @return array
     */
    public function includedCompany(Company $company, $attributes = [])
    {
        return array_merge([
            'id' => $company->id(),
            'name' => $company->name(),
            'email' => $company->email(),
            'website' => $company->website(),
            'telephone' => $company->telephone(),
            'vat' => $company->vat(),
            'accountRelation' => [
                'data' => $this->includedAccount($company->account()),
            ]
        ], $attributes);
    }

    /**
     * @param \App\Visits\Visit $visit
     * @param $attributes
     * @return array
     */
    public function includedVisit(Visit $visit, $attributes = [])
    {
        return array_merge([
            'id' => $visit->id(),
            'expected_arrival' => $visit->expectedArrival()->toIso8601String(),
            'expected_departure' => $visit->expectedDeparture()->toIso8601String(),
            'arrival' => $visit->arrival()->toIso8601String(),
            'departure' => $visit->departure()->toIso8601String(),
            'is_completed' => true,
            'accountRelation' => [
                'data' => $this->includedAccount($visit->account()),
            ],
            'employeeRelation' => [
                'data' => $this->includedEmployee($visit->employee()),
            ],
            'visitorRelation' => [
                'data' => $this->includedVisitor($visit->visitor()),
            ],
        ], $attributes);
    }

    /**
     * @param \App\Keys\Key $key
     * @param array $attributes
     * @return array
     */
    public function includedKey(Key $key, $attributes = [])
    {
        return array_merge([
            'id' => $key->id(),
            'name' => $key->name(),
            'number' => $key->number(),
            'key_code' => $key->keyCode(),
            'description' => $key->description(),
            'accountRelation' => [
                'data' => $this->includedAccount($key->account()),
            ],
        ], $attributes);
    }

    /**
     * @param \App\Incidents\Incident $incident
     * @param array $attributes
     * @return array
     */
    public function includedIncident(Incident $incident, $attributes = [])
    {
        return array_merge([
            'id' => $incident->id(),
            'type' => $incident->type(),
            'created_at' => $incident->createdAt()->toIso8601String(),
            'ended_at' => $incident->endedAt()->toIso8601String(),
            'accountRelation' => [
                'data' => $this->includedAccount($incident->account()),
            ]
        ], $attributes);
    }

    /**
     * @param \App\Locations\Buildings\Building $building
     * @param array $attributes
     * @return array
     */
    public function includedBuilding(Building $building, $attributes = [])
    {
        return array_merge([
            'id' => $building->id(),
            'name' => $building->name(),
            'accountRelation' => [
                'data' => $this->includedAccount($building->account()),
            ],
        ], $attributes);
    }
}
