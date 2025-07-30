<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team',function(Blueprint $table){
              $table->id();
              $table->string('name');
              $table->string('email')->nullable();
              $table->string('image');
              $table->string('address')->nullable();
              $table->string('post');
              $table->string('occupation')->nullable();
              $table->string('education')->nullable();
              $table->string('expertise')->nullable();
              $table->string('focus')->nullable();
              $table->string('message',10000)->nullable();
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
