<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMkUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("serial");
            $table->string("pass");
            $table->string("mail")->nullable();
            $table->string("mail_code")->nullable();
            $table->integer("active")->default(1);
            $table->integer("kengen")->default(0);
            $table->string("name")->nullable();
            $table->integer("company_id")->nullable();
            $table->timestamp("active_date")->nullable();
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
        Schema::dropIfExists('shop_products');
    }
}
