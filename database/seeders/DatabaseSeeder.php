<?php

namespace Database\Seeders;

use App\Models\Advertiser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Advertiser::factory(5)->create();
    }
}
