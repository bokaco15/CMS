<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        $postIds = Post::all()->pluck('id')->toArray();
        $tagIds = Tag::all()->pluck('id')->toArray();

        foreach ($postIds as $postId) {
            $randomTagIds = collect($tagIds)->random(min(3, count($tagIds)))->unique();

            foreach ($randomTagIds as $tagId) {
                DB::table('post_tags')->insert([
                    'post_id' => $postId,
                    'tag_id'  => $tagId,
                ]);
            }
        }
    }
}
