<?php

use App\Accounts\Account;
use App\Keys\Key;
use App\Locations\Buildings\Building;
use App\Locations\Doors\Door;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Door::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on(Account::TABLE)->onDelete('cascade');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on(Building::TABLE)->onDelete('cascade');
            $table->integer('key_id')->unsigned();
            $table->foreign('key_id')->references('id')->on(Key::TABLE)->onDelete('cascade');
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
        Schema::drop(Door::TABLE);
    }
}
