<?php

namespace Database\Factories;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->name();
        $slug = Str::slug($title);

        $categories = ArticleCategory::all()->pluck('id');

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->text(),
            'author' => $this->faker->name(),
            'tags' => $this->faker->text(10),
            'is_show' => 1,
            'is_approved' => 0,
            'article_category_id' => $this->faker->randomElement($categories)
        ];
    }
}
