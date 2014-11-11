<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemDescriptorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('problemDescriptors', function(Blueprint $table)
		{
			$table->integer('problemId', true);
			$table->string('problemName', 15)->nullable()->unique('problemName');
			$table->string('problemQuestion', 310)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('problemDescriptors');
	}

}
