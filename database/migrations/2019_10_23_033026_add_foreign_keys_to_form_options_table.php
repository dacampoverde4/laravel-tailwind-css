<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFormOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('form_options', function(Blueprint $table)
		{
			$table->foreign('field_id', 'form_options_ibfk_1')->references('id')->on('forms')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('form_options', function(Blueprint $table)
		{
			$table->dropForeign('form_options_ibfk_1');
		});
	}

}
