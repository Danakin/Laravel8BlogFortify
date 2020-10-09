<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(6, true);
        $slug = Str::slug(date('Ymd') . '-' . substr($title, 0, 55), '-');
        return [
            'user_id' => $this->faker->biasedNumberBetween(1, 3),
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->paragraphs(3, true),
            'published' => $this->faker->biasedNumberBetween(0, 1),
        ];
    }
}
