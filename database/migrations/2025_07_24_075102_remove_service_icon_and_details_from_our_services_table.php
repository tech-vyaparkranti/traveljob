<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveServiceIconAndDetailsFromOurServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('our_services', function (Blueprint $table) {
            $table->dropColumn('service_details');
            $table->dropColumn('service_icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('our_services', function (Blueprint $table) {
            // Re-adding the columns with their original definitions for rollback purposes
            $table->string('service_details', 500)->nullable(false);
            $table->string('service_icon', 100)->nullable(false);
        });
    }
}