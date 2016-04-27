<?php

use App\Accounts\Account;
use App\Tasks\Task;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Task::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->dateTime('expected_start');
            $table->dateTime('expected_end');
            $table->dateTime('finished')->nullable();
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
        Schema::drop(Task::TABLE);
    }
}
