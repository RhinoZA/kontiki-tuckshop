<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('quantity');
			
			$table->boolean('is_completed');
			
			$table->integer('order_id')->unsigned();
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
			
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			
			$table->integer('kitchen_id')->unsigned()->nullable();
			$table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
			
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
		Schema::drop('order_items');
	}

}
