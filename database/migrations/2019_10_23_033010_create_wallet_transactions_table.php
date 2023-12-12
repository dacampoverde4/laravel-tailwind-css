<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWalletTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wallet_transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('wallet_id')->unsigned()->index('wallet_transactions_wallet_id_foreign');
			$table->integer('amount');
			$table->string('hash', 60);
			$table->string('type', 30);
			$table->boolean('accepted');
			$table->text('meta', 65535)->nullable();
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
		Schema::drop('wallet_transactions');
	}

}
