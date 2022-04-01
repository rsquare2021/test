<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("quantity");
            $table->unsignedBigInteger("apply_status_id");
            $table->foreign("apply_status_id")->on("apply_statuses")->references("id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->on("users")->references("id");
            $table->unsignedBigInteger("campaign_product_id");
            $table->foreign("campaign_product_id")->on("campaign_products")->references("id");
            $table->unsignedBigInteger("product_id")->nullable();
            $table->foreign("product_id")->on("products")->references("id");
            $table->unsignedBigInteger("shipping_address_id")->nullable();
            $table->foreign("shipping_address_id")->on("shipping_addresses")->references("id")->onDelete("set null");
            // giftee_box
            $table->string("issue_identity")->nullable();
            $table->string("giftee_box_url")->nullable();

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
        Schema::dropIfExists('applies');
    }
}
