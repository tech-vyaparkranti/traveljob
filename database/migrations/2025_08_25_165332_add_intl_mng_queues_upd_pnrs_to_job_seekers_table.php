<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIntlMngQueuesUpdPnrsToJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seekers', function (Blueprint $table) {
              $table->boolean('intl_mng_queues_upd_pnrs')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seekers', function (Blueprint $table) {
             Schema::dropIfExists('job_seekers');
        });
    }
}
