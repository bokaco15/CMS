<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();

        User::factory()->create([
            'name' => "Borislav",
            'slug' => "borislav-ilic",
            'email' => 'bborislavilic@gmail.com',
            'password' => Hash::make('bokaco123'),
            'is_banned' => 0,
            'phone' => $faker->phoneNumber,
        ]);

        for($i = 0; $i < 10; $i++){
            User::factory()->create([
                'name' => $faker->name,
                'slug' => $faker->slug,
                'email' => $faker->email,
                'password' => Hash::make('bokaco123'),
                'is_banned' => 0,
                'phone' => $faker->phoneNumber,
            ]);
        }


        $this->call([
           CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            PostTagSeeder::class,
        ]);

    }
}
