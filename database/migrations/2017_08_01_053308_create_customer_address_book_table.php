<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddressBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_address_book', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('customer_id');
			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->string('phone');
			$table->string('address');
			$table->string('address2')->nullable();
			$table->string('city');
			$table->string('postcode');
			$table->string('country');
			$table->string('is_billing')->default(0);
			$table->string('is_shipping')->default(0);
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
        Schema::dropIfExists('customer_address_book');
    }
}
