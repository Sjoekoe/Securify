<?php
namespace functional\Api\People;

use App\Helpers\DefaultIncludes;
use App\Visitors\Visitor;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VisitorsTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_visitors_for_an_account()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);
        $visitor = $this->createVisitor([
            'account_id' => $account->id(),
            'company_id' => $company->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/visitors', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedVisitor($visitor),
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
    function it_can_create_a_visitor()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);

        $this->post('/api/accounts/' . $account->id() . '/visitors', [
            'name' => 'post visitor',
            'company_id' => $company->id(),
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => [
                'id' => DB::table(Visitor::TABLE)->first()->id,
                'name' => 'post visitor',
                'accountRelation' => [
                    'data' => $this->includedAccount($account),
                ],
                'companyRelation' => [
                    'data' => $this->includedCompany($company),
                ],
            ],
        ]);
    }

    /** @test */
    function it_can_show_a_visitor()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);
        $visitor = $this->createVisitor([
            'account_id' => $account->id(),
            'company_id' => $company->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/visitors/' . $visitor->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedVisitor($visitor),
            ]);
    }

    /** @test */
    function it_can_update_a_visitor()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);
        $visitor = $this->createVisitor([
            'account_id' => $account->id(),
            'company_id' => $company->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/visitors/' . $visitor->id(), [
            'name' => 'updated name',
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => $this->includedVisitor($visitor, [
                'name' => 'updated name',
            ])
        ]);
    }

    /** @test */
    function it_can_delete_a_visitor()
    {
        $account = $this->createAccount();
        $company = $this->createCompany([
            'account_id' => $account->id(),
        ]);
        $visitor = $this->createVisitor([
            'account_id' => $account->id(),
            'company_id' => $company->id(),
        ]);

        $this->seeInDatabase(Visitor::TABLE, [
            'id' => $visitor->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/visitors/' . $visitor->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Visitor::TABLE, [
            'id' => $visitor->id(),
        ]);
    }
}
