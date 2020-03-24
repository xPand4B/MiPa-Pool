<?php

use MiPaPo\Core\Components\Menu\Database\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Menu::TABLE_NAME, function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('user_id');
            $table->uuid('order_id');

            $table->string('name', 100);
            $table->integer('number');
            $table->text('comment')->nullable();
            // Instead of 5,65€ + 6,33€ this value is multiplied by 10^-2 or 0,01
            // 5,65 + 6,33 = 14,98
            // (565 + 633) = 1498
            // 1498 * 10^-2 = 14,98
            $table->integer('price');
            $table->boolean('payed')->default(false);

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
        Schema::dropIfExists(Menu::TABLE_NAME);
    }
}
