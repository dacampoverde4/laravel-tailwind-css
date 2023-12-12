<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_options', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('field_id')->index('form_options_ibfk_1');
			$table->string('label');
			$table->integer('sort_id');
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
		Schema::drop('form_options');
	}

}
