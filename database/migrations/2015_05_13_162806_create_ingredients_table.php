<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingredients', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('prepared_product_id')->unsigned();
			$table->foreign('prepared_product_id')->references('id')->on('products')->onDelete('cascade');
			
			$table->integer('ingredient_product_id')->unsigned();
			$table->foreign('ingredient_product_id')->references('id')->on('products')->onDelete('cascade');
			
			$table->integer('quantity');
			
			
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
		Schema::drop('ingredients');
	}

}
