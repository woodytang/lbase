<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('category_id')->nullable();
			$table->string('title');
			$table->string('slug');
			$table->text('content', 65535);
			$table->integer('order')->nullable();
			$table->boolean('featured')->nullable();
			$table->string('meta_title')->default('');
			$table->integer('view_count')->nullable()->default(0);
			$table->string('meta_description')->default('');
			$table->string('meta_keywords')->default('');
			$table->timestamps();
			$table->integer('clicks')->nullable();
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
