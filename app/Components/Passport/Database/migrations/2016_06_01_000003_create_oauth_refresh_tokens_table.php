<?php

use App\Components\Passport\Database\RefreshToken;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOauthRefreshTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(RefreshToken::TABLE_NAME, function (Blueprint $table) {
            $table->string('id', 100)->primary();

            $table->string('access_token_id', 100)->index();
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
        Schema::dropIfExists(RefreshToken::TABLE_NAME);
    }
}
