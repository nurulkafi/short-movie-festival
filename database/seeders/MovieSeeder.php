<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {

            // insert data ke table pegawai menggunakan Faker
            Movie::create([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'duration' => $faker->randomDigit()." Hours",
                'artists' => $faker->name,
                'genres' => $faker->sentence(1)
            ]);
        }
    }
}
