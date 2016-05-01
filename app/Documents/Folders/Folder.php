<?php
namespace App\Documents\Folders;

interface Folder
{
    const TABLE = 'document_folders';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return \string
     */
    public function name();

    /**
     * @return \App\Accounts\Account
     */
    public function account();

    /**
     * @return \App\Documents\Document
     */
    public function document();

    /**
     * @return \App\Documents\Folders\Folder|null
     */
    public function parentFolder();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();
}
