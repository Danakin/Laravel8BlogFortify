<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Post;

use App\Helper\MakeSlug;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $title = 'Testing a post';
        $slug = MakeSlug::makeSlug($title);
        Post::create([
            'user_id' => 1,
            'title' => $title,
            'slug' => $slug,
            'description' => 'This is a first post, inserted by a seeder',
            'published' => true,
        ]);

        Post::factory()
            ->times(9)
            ->create();
    }
}
