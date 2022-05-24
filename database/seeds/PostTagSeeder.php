<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {

            $tags = Tag::inRandomOrder()->limit(rand(0, 5))->get();

            $post->tags()->attach($tags->pluck('id')->all());
        }
    }
}
