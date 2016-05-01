<?php
namespace functional\Api\Documents;

use App\Documents\Folders\Folder;
use App\Helpers\DefaultIncludes;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FoldersTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_folders_for_a_document()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);
        $folder = $this->createFolder([
            'account_id' => $account->id(),
            'document_id' => $document->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/documents/' . $document->id() . '/folders', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedFolder($folder),
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
    function it_can_create_a_folder()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);

        $this->post('/api/accounts/' . $account->id() . '/documents/' . $document->id() . '/folders', [
            'name' => 'Test folder',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Folder::TABLE)->first()->id,
                    'name' => 'Test folder',
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                    'documentRelation' => [
                        'data' => $this->includedDocument($document),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_a_folder()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);
        $folder = $this->createFolder([
            'account_id' => $account->id(),
            'document_id' => $document->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/documents/' . $document->id() . '/folders/' . $folder->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedFolder($folder),
            ]);
    }

    /** @test */
    function it_can_update_a_folder()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);
        $folder = $this->createFolder([
            'account_id' => $account->id(),
            'document_id' => $document->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/documents/' . $document->id() . '/folders/' . $folder->id(), [
            'name' => 'updated folder',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedFolder($folder, [
                    'name' => 'updated folder',
                ]),
            ]);
    }

    /** @test */
    function it_can_delete_a_folder()
    {
        $account = $this->createAccount();
        $document = $this->createDocument([
            'account_id' => $account->id(),
        ]);
        $folder = $this->createFolder([
            'account_id' => $account->id(),
            'document_id' => $document->id(),
        ]);

        $this->seeInDatabase(Folder::TABLE, [
            'id' => $folder->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/documents/' . $document->id() . '/folders/' . $folder->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Folder::TABLE, [
            'id' => $folder->id(),
        ]);
    }
}
