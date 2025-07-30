<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings',function(Blueprint $table){
            $table->id();
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('company_name',500)->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('address',500)->nullable();
            $table->string('whatsapp_no')->nullable();
            $table->string('call_no')->nullable();
            $table->string('copyright_txt')->nullable();
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
