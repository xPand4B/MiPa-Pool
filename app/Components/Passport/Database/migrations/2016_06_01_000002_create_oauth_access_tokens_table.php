<?php

use App\Components\Passport\Database\Token;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOauthAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Token::TABLE_NAME, function (Blueprint $table) {
            $table->string('id', 100)->primary();

            $table->uuid('user_id')->index()->nullable();
            $table->unsignedBigInteger('client_id');

            $table->string('name')->nullable();
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
        Schema::dropIfExists(Token::TABLE_NAME);
    }
}
