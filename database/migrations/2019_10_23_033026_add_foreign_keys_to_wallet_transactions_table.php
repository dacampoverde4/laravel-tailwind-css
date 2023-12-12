<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWalletTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wallet_transactions', function(Blueprint $table)
		{
			$table->foreign('wallet_id')->references('id')->on('wallets')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wallet_transactions', function(Blueprint $table)
		{
			$table->dropForeign('wallet_transactions_wallet_id_foreign');
		});
	}

}
