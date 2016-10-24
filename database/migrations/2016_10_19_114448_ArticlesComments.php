<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticlesComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('articlescomments', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('name');		
			$table->string('body')->nullable();
			$table->unsignedInteger('article_id');			
			$table->foreign('article_id')->references('id')->on('articles');						
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
		Schema::drop('articlecomments');
    }
}
