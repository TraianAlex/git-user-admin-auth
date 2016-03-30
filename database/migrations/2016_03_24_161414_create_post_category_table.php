<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_categories', function (Blueprint $table) {
            $table->integer('post_id')->unsigned()->index();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->primary(['post_id', 'category_id']);
            $table->timestamps();

            //$table->integer('tag_id')->unsigned()->index();
            //$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            //$table->integer('tweet_id')->unsigned()->index();
            //$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            //$table->primary(['tag_id', 'tweet_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts_categories');
    }
}
