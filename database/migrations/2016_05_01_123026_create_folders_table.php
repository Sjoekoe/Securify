<?php

use App\Accounts\Account;
use App\Documents\Document;
use App\Documents\Folders\Folder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Folder::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on(Account::TABLE)->onDelete('cascade');
            $table->integer('document_id')->unsigned();
            $table->foreign('document_id')->references('id')->on(Document::TABLE)->onDelete('cascade');
            $table->integer('parent_folder_id')->unsigned()->nullable();
            $table->foreign('parent_folder_id')->references('id')->on(Folder::TABLE)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Folder::TABLE);
    }
}
