<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemParametersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('problemParameters', function(Blueprint $table)
		{
			$table->integer('parameterId', true);
			$table->integer('linkedProblemId');
			$table->string('parameterName', 10)->nullable();
			$table->string('parameterProperName', 15)->nullable();
			$table->bigInteger('parameterDefaultValue')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('problemParameters');
	}

}
