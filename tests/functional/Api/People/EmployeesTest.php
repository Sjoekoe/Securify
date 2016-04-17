<?php
namespace functional\Api\People;

use App\Employees\Employee;
use App\Helpers\DefaultIncludes;

class EmployeesTest extends \TestCase
{
    use DefaultIncludes;

    /** @test */
    function it_can_get_all_employees_for_an_account()
    {
        $account = $this->createAccount();
        $employee = $this->createEmployee([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/employees')
            ->seeJsonEquals([
                'data' => [
                    $this->includedEmployee($employee),
                ],
                'meta' => [
                    'pagination' => [
                        'count' => 1,
                        'current_page' => 1,
                        'links' => [],
                        'per_page' => 10,
                        'total' => 1,
                        'total_pages' => 1,
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_create_an_employee()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/employees', [
            'name' => 'Test employee',
            'email' => 'test@employee.com',
        ])->seeJsonEquals([
            'data' => [
                'id' => 1,
                'name' => 'Test employee',
                'email' => 'test@employee.com',
                'number' => null,
                'telephone' => null,
                'accountRelation' => [
                    'data' => $this->includedAccount($account)
                ]
            ]
        ]);
    }

    /** @test */
    function it_can_show_an_employee()
    {
        $account = $this->createAccount();
        $employee = $this->createEmployee([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/employees/' . $employee->id())
            ->seeJsonEquals([
                'data' => $this->includedEmployee($employee),
            ]);
    }

    /** @test */
    function it_can_update_an_employee()
    {
        $account = $this->createAccount();
        $employee = $this->createEmployee([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/employees/' . $employee->id(), [
            'name' => 'updated employee',
            'email' => 'updated@email.com',
        ])->seeJsonEquals([
            'data' => $this->includedEmployee($employee, [
                'name' => 'updated employee',
                'email' => 'updated@email.com',
            ]),
        ]);
    }

    /** @test */
    function it_can_delete_an_employee()
    {
        $account = $this->createAccount();
        $employee = $this->createEmployee([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Employee::TABLE, [
            'id' => $employee->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/employees/' . $employee->id())
            ->assertNoContent();

        $this->missingFromDatabase(Employee::TABLE, [
            'id' => $employee->id(),
        ]);
    }
}
