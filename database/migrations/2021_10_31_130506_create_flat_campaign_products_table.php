<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatCampaignProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS flat_campaign_products");
        DB::statement(<<<EOM
            CREATE VIEW flat_campaign_products AS
            with recursive flat_campaign_products(depth, id, campaign_id) as (
                select 0, id, campaign_id
                from campaign_products
                where campaign_id is not null
                union all
                select B1.depth + 1, A1.id, B1.campaign_id
                from campaign_products as A1, flat_campaign_products as B1
                where A1.course_id = B1.id
            )
            select * from flat_campaign_products;
EOM
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS flat_campaign_products");
    }
}
