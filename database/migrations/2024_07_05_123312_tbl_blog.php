<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('blog',function(Blueprint $table){
           $table->id();
           $table->string('blog_title',500);
           $table->string('blog_desc',3000);
           $table->date('blog_date');
           $table->string('image');
           $table->integer('status')->default('1')->nullable(false);
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
        //
    }
}
