<?php

use App\Accounts\Account;
use App\Employees\Employee;
use App\Visitors\Visitor;
use App\Visits\Visit;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Visit::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('expected_arrival');
            $table->dateTime('expected_departure')->nullable();
            $table->dateTime('arrival')->nullable();
            $table->dateTime('departure')->nullable();
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on(Account::TABLE)->onDelete('cascade');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on(Employee::TABLE)->onDelete('cascade');
            $table->integer('visitor_id')->unsigned();
            $table->foreign('visitor_id')->references('id')->on(Visitor::TABLE)->onDelete('cascade');
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
        Schema::drop(Visit::TABLE);
    }
}
