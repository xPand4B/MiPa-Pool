<?php

use MiPaPo\Core\Components\Order\Database\Order;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Order::TABLE_NAME, function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('user_id');

            $table->string('name');
            $table->string('delivery_service');
            $table->string('site_link');
            $table->dateTime('deadline');
            $table->integer('minimum_value');
            $table->integer('max_orders');
            $table->boolean('closed')->default(false);

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
        Schema::dropIfExists(Order::TABLE_NAME);
    }
}
