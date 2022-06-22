<?php

namespace Database\Seeders;

use App\Models\Website;
use App\Models\Post;
use App\Models\Subscription;
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
        Website::factory()
        ->hasPosts(5)
        ->hasSubscriptions(3)
        ->count(15)
        ->create();
    }
}
