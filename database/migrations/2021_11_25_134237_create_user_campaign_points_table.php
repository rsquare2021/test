<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCampaignPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_campaign_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->on("users")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("campaign_id");
            $table->foreign("campaign_id")->on("campaigns")->references("id")->onDelete("cascade");
            $table->integer("remaining_point")->default(0);
            $table->integer("total_point")->default(0);
            $table->integer("accept_count")->default(0);
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
        Schema::dropIfExists('user_campaign_points');
    }
}
