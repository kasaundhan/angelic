<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('order_item', function (Blueprint $table) {
            $table->increments('id');
			$table->string('order_id')->nullable();		
			$table->string('item_code')->nullable();
			$table->decimal('price',20,2);
			$table->integer('quantity')->nullable();
			$table->string('discount')->nullable();
			$table->string('discount_type')->nullable();
			$table->decimal('total',20,2)->nullable();
			$table->decimal('subtotal',20,2)->nullable();
			$table->string('ring');
			$table->string('metal');
			$table->text('description')->nullable();
			$table->text('delivery_method')->nullable();
			$table->text('customer_note')->nullable();
			$table->text('staff_note')->nullable();
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
       Schema::dropIfExists('order_item');
    }
}
