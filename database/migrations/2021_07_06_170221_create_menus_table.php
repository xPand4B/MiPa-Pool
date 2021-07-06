<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('order_id')->constrained();
            $table->string('name', 100);
            $table->integer('number');
            $table->text('comment')->nullable();
            // Instead of 5,65€ + 6,33€ this value is multiplied by 10^-2 or 0,01
            // 5,65 + 6,33 = 14,98
            // (565 + 633) = 1498
            // 1498 * 10^-2 = 14,98
            $table->integer('price');
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
}
