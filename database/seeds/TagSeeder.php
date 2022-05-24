<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['javascript', 'pizza', 'laravel', 'ether', 'Bitcoin', 'estero', 'NFT', 'php', 'oop', 'javascript', 'Italia'];

        foreach ($tags as $tag) {
            Tag::create([
                'name'  => $tag,
                'slug'  => Str::slug($tag),
            ]);
        }
    }
}
