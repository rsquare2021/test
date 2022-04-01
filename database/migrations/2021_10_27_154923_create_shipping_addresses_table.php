<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("company_name")->nullable();
            $table->string("personal_name");
            $table->string("personal_name_kana");
            $table->string("post_code");
            $table->string("prefectures");
            $table->string("municipalities");
            $table->string("address_code");
            $table->string("building")->nullable();
            $table->string("tel");
            $table->unsignedBigInteger("delivery_time_id");
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
        Schema::dropIfExists('shipping_addresses');
    }
}
