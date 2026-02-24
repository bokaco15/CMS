<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        DB::table('tags')->truncate();
        $faker = Factory::create();

        for($i=0; $i<100; $i++) {
            $name = $faker->unique()->word();
            DB::table('tags')->insert([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

    }
}
