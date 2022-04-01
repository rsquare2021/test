<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call([
            UsersTableSeeder::class,
            ShopTreeSeeder::class,
            CompanySeeder::class,
            AdminSeeder::class,
            ProductSeeder::class,
            CampaignSeeder::class,
            ApplySeeder::class,
            ReceiptSeeder::class,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
