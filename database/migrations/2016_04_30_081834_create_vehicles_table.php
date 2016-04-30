<?php

use App\Accounts\Account;
use App\Vehicles\Vehicle;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Vehicle::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('license_plate');
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
        Schema::drop(Vehicle::TABLE);
    }
}
