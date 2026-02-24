<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

//        DB::table('categories')->truncate();

        for($i = 1; $i <= 10; $i++){
            $name = $faker->words(mt_rand(1, 3), true);
            DB::table('categories')->insert([
                'name' => $name,
                'slug' => Str::slug($name),
                'show_on_index' => 1,
                'priority' => $i,
            ]);
        }
    }
}
