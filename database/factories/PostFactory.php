<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Helper\MakeSlug;

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
        $slug = MakeSlug::makeSlug($title);
        return [
            'user_id' => $this->faker->biasedNumberBetween(1, 3),
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->paragraphs(3, true),
            'published' => $this->faker->biasedNumberBetween(0, 1),
        ];
    }
}
