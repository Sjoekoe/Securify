<?php

use App\Accounts\Account;
use App\Companies\Company;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Company::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('vat')->nullable();
            $table->string('telephone')->nullable();
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on(Account::TABLE)->onDelete('cascade');
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
        Schema::drop(Company::TABLE);
    }
}
