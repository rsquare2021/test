<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->dateTime("publish_datetime");
            $table->dateTime("close_datetime");
            $table->dateTime("start_datetime_to_convert_receipts_to_points");
            $table->dateTime("end_datetime_to_convert_receipts_to_points");
            $table->unsignedBigInteger("campaign_type_id");
            $table->foreign("campaign_type_id")->on("campaign_types")->references("id");
            $table->text("application_requirements");
            $table->text("terms_of_service");
            $table->text("privacy_policy");
            $table->boolean("is_crawlable")->nullable();
            $table->unsignedBigInteger("company_id");
            $table->foreign("company_id")->on("companies")->references("id");
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
        Schema::dropIfExists('campaigns');
    }
}
