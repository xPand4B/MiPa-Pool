<?php

use App\Components\Passport\Database\AuthCode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOauthAuthCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(AuthCode::TABLE_NAME, function (Blueprint $table) {
            $table->string('id', 100)->primary();

            $table->uuid('user_id');
            $table->unsignedBigInteger('client_id');

            $table->text('scopes')->nullable();
            $table->boolean('revoked');

            $table->dateTimeTz('expires_at')->nullable();
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
        Schema::dropIfExists(AuthCode::TABLE_NAME);
    }
}
