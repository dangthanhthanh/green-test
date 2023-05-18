<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ArticleCategory::factory(10)->create();
    }
}
