<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name();
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'short_description' => $this->faker->text(),
            'description' => $this->faker->text(),
            'information' => $this->faker->text(),
            'price' => $this->faker->numberBetween(100, 99999),
            'qty' => $this->faker->numberBetween(100, 99999),
            'weight' => $this->faker->numberBetween(100, 99999),
            'shipping' => $this->faker->numberBetween(1, 10),
            'status' => 1,
            'slug' => $slug,
            'product_category_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
