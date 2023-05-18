<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();
        \App\Models\ArticleCategory::factory(10)->create();
        \App\Models\ProductCategory::factory(10)->create();
        \App\Models\Article::factory(10)->create();
        \App\Models\Product::factory(10)->create();
    }
}
