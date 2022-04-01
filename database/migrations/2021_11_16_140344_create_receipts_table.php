<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("campaign_id")->nullable();
            $table->string("user_id");
            $table->integer("point")->nullable();
            $table->string("code")->nullable();
            $table->string("products")->nullable();
            $table->string("total_price")->nullable();
            $table->string("tel")->nullable();
            $table->Integer("direct")->nullable();
            $table->string("no")->nullable();
            $table->integer("status")->nullable();
            $table->string("pay_date")->nullable();
            $table->string("time")->nullable();
            $table->string("receipt_path");
            $table->string("mk_status");
            $table->integer("status_product")->default(0)->nullable();
            $table->integer("status_oil")->default(0)->nullable();
            $table->integer("status_input")->default(0)->nullable();
            $table->integer("status_diff")->default(0)->nullable();
            $table->integer("status_term")->default(0)->nullable();
            $table->integer("status_shop")->default(0)->nullable();
            $table->integer("status_double")->default(0)->nullable();
            $table->integer("status_ngword")->default(0)->nullable();
            $table->integer("status_count")->default(0)->nullable();
            $table->integer("status_multi")->default(0)->nullable();
            $table->integer("status_nodata")->default(0)->nullable();
            $table->string("tel_company")->nullable();
            $table->string("company")->nullable();
            $table->decimal("receipt_value", 8, 2);
            $table->integer("meken_value")->nullable();
            $table->integer("meken_after_value")->nullable();
            $table->string("receipt_str",1000);
            $table->string("receipt_memo",1000)->nullable();
            $table->string("mk_no")->nullable();
            $table->string("mk_tel")->nullable();
            $table->string("mk_date")->nullable();
            $table->string("mk_time")->nullable();
            $table->decimal("mk_value", 8, 2)->nullable();
            $table->string("mk_user_id")->nullable();
            $table->dateTime('meken_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('receipts');
    }
}
