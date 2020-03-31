<?php

use MiPaPo\Core\Components\User\Database\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(User::TABLE_NAME, function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('username')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('initials');
            $table->string('email')->unique();
            $table->date('birthday')->nullable();
            $table->string('avatar')->nullable();
            $table->string('locale')->default(config('app.locale'));
            $table->boolean('darkmode')->default(false);

            $table->string('password');
            $table->string('api_token')->unique()->nullable()->default(null);
            $table->rememberToken();

            $table->timestampTz('email_verified_at')->nullable();
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
        Schema::dropIfExists(User::TABLE_NAME);
    }
}
