<?php
namespace functional\Api\Companies;

use App\Companies\Company;
use App\Helpers\DefaultIncludes;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompaniesTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_companies_for_an_account()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/companies', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedCompany($company),
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
                ]
            ]);
    }

    /** @test */
    function it_can_create_a_company()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/companies', [
            'name' => 'Creating company',
            'email' => 'info@company.com',
            'website' => 'www.company.com',
            'telephone' => '123456',
            'vat' => '567890',
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => [
                'id' => DB::table(Company::TABLE)->first()->id,
                'name' => 'Creating company',
                'email' => 'info@company.com',
                'website' => 'http://www.company.com',
                'telephone' => '123456',
                'vat' => '567890',
                'accountRelation' => [
                    'data' => $this->includedAccount($account),
                ],
            ],
        ]);
    }

    /** @test */
    function it_can_not_show_a_company_that_does_not_belong_to_the_account()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);
        $account2 = $this->createAccount();
        $this->get('/api/accounts/' . $account2->id() . '/companies/' . $company->id(), $this->setJWTHeaders())
            ->assertForbidden();
    }

    /** @test */
    function it_can_show_a_company()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/companies/' . $company->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedCompany($company),
            ]);
    }

    /** @test */
    function it_can_update_a_company()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/companies/' . $company->id(), [
            'name' => 'updated Name',
            'email' => 'updated@test.com',
            'website' => 'www.updated.com',
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => $this->includedCompany($company, [
                'name' => 'updated Name',
                'email' => 'updated@test.com',
                'website' => 'http://www.updated.com',
            ]),
        ]);
    }

    /** @test */
    function it_can_delete_a_company()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Company::TABLE, [
            'id' => $company->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/companies/' . $company->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Company::TABLE, [
            'id' => $company->id(),
        ]);
    }
}
