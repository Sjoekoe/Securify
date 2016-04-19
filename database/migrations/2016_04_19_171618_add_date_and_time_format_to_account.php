<?php

use App\Accounts\Account;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateAndTimeFormatToAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Account::TABLE, function (Blueprint $table) {
            $table->string('date_format')->default('d-m-y');
            $table->string('time_format')->default('HH:MM');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Account::TABLE, function (Blueprint $table) {
            $table->dropColumn(['date_format', 'time_format']);
        });
    }
}
