<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopTreeElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_tree_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->foreign("parent_id")->on("shop_tree_elements")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("shop_tree_level_id");
            $table->string("tel")->nullable();
            $table->string("tel_sub")->nullable();
            $table->string("code1")->nullable();
            $table->string("code2")->nullable();
            $table->string("code3")->nullable();
            $table->string("code4")->nullable();
            $table->string("code5")->nullable();
            $table->Integer("direct")->nullable();
            $table->foreign("shop_tree_level_id")->on("shop_tree_levels")->references("id");
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('shop_tree_elements');
        Schema::enableForeignKeyConstraints();
    }
}