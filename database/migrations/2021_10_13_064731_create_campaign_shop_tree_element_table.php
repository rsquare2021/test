<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignShopTreeElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_shop_tree_element', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("campaign_id");
            $table->foreign("campaign_id")->on("campaigns")->references("id")->onDelete("cascade");
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
        Schema::dropIfExists('campaign_shop_tree_element');
    }
}
