<?php

use MiPaPo\Core\Components\Passport\Database\PersonalAccessClient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOauthPersonalAccessClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PersonalAccessClient::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('client_id')->index();

            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(PersonalAccessClient::TABLE_NAME);
    }
}
