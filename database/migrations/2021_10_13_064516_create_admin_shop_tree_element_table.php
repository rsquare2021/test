<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminShopTreeElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_shop_tree_element', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("admin_id");
            $table->foreign("admin_id")->on("admins")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("shop_tree_element_id");
            $table->foreign("shop_tree_element_id")->on("shop_tree_elements")->references("id")->onDelete("cascade");
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
        Schema::dropIfExists('admin_shop_tree_element');
    }
}
