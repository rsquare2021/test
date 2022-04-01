<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMkStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('normal_display_name')->nullable();
            $table->string('admin_display_name')->nullable();
            $table->string('status_memo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mk_statuses');
    }
}
