<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateCampaignProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            // ↓ キャンペーンタイプよって使ったり使わなかったりするもの。
            $table->unsignedBigInteger("campaign_id")->nullable();
            $table->foreign("campaign_id")->on("campaigns")->references("id")->onDelete("cascade");
            $table->string("name")->nullable();
            $table->integer("point")->nullable();
            $table->float("win_rate")->nullable();
            $table->integer("win_limit")->nullable();
            $table->unsignedBigInteger("lottery_type_id")->nullable();
            $table->foreign("lottery_type_id")->on("lottery_types")->references("id");
            $table->unsignedBigInteger("product_id")->nullable();
            $table->foreign("product_id")->on("products")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("course_id")->nullable();
            $table->foreign("course_id")->on("campaign_products")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("double_up_course_id")->nullable();
            $table->foreign("double_up_course_id")->on("campaign_products")->references("id")->onDelete("set null");
            $table->unsignedBigInteger("gift_delivery_method_id")->nullable();
            $table->foreign("gift_delivery_method_id")->on("gift_delivery_methods")->references("id");
            // giftee_box
            $table->integer("recommend")->default(null)->nullable();
            $table->string("access_token")->nullable();
            $table->string("config_code")->nullable();
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
        Schema::dropIfExists('campaign_products');
    }
}
