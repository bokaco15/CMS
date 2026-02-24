<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        DB::table('posts')->truncate();
        $faker = Factory::create();

        for($i = 0; $i < 1000; $i++){
            $heading = $faker->sentence();
            DB::table('posts')->insert([
                'heading' => $heading,
                'slug' => Str::slug($heading),
                'preheading' => $faker->paragraph(2, true),
                'text'=>$faker->text(1000),
                'category_id' => rand(1, 10),
                'image'=>'https://placehold.co/725x485',
                'important'=>rand(0,1),
                'published'=>mt_rand(0,1),
                'user_id' => 1,
                'created_at' => now(),
            ]);
        }

    }
}
