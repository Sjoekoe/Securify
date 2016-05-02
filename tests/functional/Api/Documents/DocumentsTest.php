<?php
namespace functional\Api\Documents;

use App\Documents\Document;
use App\Helpers\DefaultIncludes;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DocumentsTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_documents_for_an_account()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/documents', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedDocument($document),
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
    function it_can_create_a_document()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/documents', [
            'name' => 'Foo name',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Document::TABLE)->first()->id,
                    'name' => 'Foo name',
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_not_show_a_document_that_does_not_belong_to_the_account()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);
        $account2 = $this->createAccount();

        $this->get('/api/accounts/' . $account2->id() . '/documents/' . $document->id(), $this->setJWTHeaders())
            ->assertForbidden();
    }

    /** @test */
    function it_can_show_a_document()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/documents/' . $document->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedDocument($document),
            ]);
    }

    /** @test */
    function it_can_update_a_document()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/documents/' . $document->id(), [
            'name' => 'updated document',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedDocument($document, [
                    'name' => 'updated document',
                ]),
            ]);
    }

    /** @test */
    function it_can_delete_a_document()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Document::TABLE, [
            'id' => $document->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/documents/' . $document->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Document::TABLE, [
            'id' => $document->id(),
        ]);
    }
}
