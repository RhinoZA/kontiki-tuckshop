<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboRulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('combo_rules', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('product_id')->unsigned()->nullable();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			
			$table->integer('combo_type_id')->unsigned()->nullable();
			$table->foreign('combo_type_id')->references('id')->on('combo_types')->onDelete('cascade');
			
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
		Schema::drop('combo_rules');
	}

}
