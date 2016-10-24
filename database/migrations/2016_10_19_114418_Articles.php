<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('articles', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('title');
			$table->string('tags')->nullable();
			$table->string('category_id')->nullable();
			$table->string('body')->nullable();	
			$table->unsignedInteger('created_by');			
			$table->foreign('created_by')->references('id')->on('users');			
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at');
			$table->softDeletes();
			
			
				
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::drop('articles');
    }
}
