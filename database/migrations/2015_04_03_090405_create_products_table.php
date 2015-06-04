<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('name');
			$table->float('cost_price');
			$table->float('selling_price');
			
			$table->integer('product_type_id')->unsigned();
			$table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
			
			$table->integer('combo_type_id')->unsigned();
			$table->foreign('combo_type_id')->references('id')->on('combo_types')->onDelete('cascade');
			
			$table->integer('product_group_id')->unsigned();
			$table->foreign('product_group_id')->references('id')->on('product_groups')->onDelete('cascade');
			
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
		Schema::drop('products');
	}

}
