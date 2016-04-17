<?php

use App\Accounts\Account;
use App\Employees\Employee;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Employee::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
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
        Schema::drop(Employee::TABLE);
    }
}
