<?php

use App\Accounts\Account;
use App\Locations\Doors\Door;
use App\Patrols\Checkpoints\Checkpoint;
use App\Patrols\Patrol;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckpointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Checkpoint::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on(Account::TABLE)->onDelete('cascade');
            $table->integer('patrol_id')->unsigned();
            $table->foreign('patrol_id')->references('id')->on(Patrol::TABLE)->onDelete('cascade');
            $table->integer('door_id')->unsigned();
            $table->foreign('door_id')->references('id')->on(Door::TABLE)->onDelete('cascade');
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
        Schema::drop(Checkpoint::TABLE);
    }
}
