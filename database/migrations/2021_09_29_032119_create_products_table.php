<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->integer("catalog_basic_point")->nullable();
            $table->integer("basic_win_limit")->nullable();
            $table->unsignedBigInteger("product_category_id")->nullable();
            $table->foreign("product_category_id")->on("product_categories")->references("id");
            $table->unsignedBigInteger("variation_parent_id")->nullable();
            $table->foreign("variation_parent_id")->on("products")->references("id")->onDelete("cascade");
            $table->string("variation_name")->nullable();
            // サプライヤcsv用
            $table->unsignedBigInteger("supplier_id")->nullable();
            $table->foreign("supplier_id")->on("suppliers")->references("id");
            $table->string("operation_id")->nullable();
            $table->longText("description_1")->nullable();
            $table->longText("description_2")->nullable();
            $table->string("notice",1000)->nullable();
            $table->string("maker_name")->nullable();
            $table->string("maker_url")->nullable();
            // giftee_box
            $table->boolean("is_giftee_box")->default(false);

            $table->timestamps();            
            $table->unique(["supplier_id", "operation_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
