<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::all()->pluck('id')->toArray();
        foreach (range(1, 10) as $index) {
            DB::table('articles')->insert([
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'content' => $faker->text($maxNbChars = 500),
                'user_id' => $faker->randomElement($users)
            ]);
        }
    }
}
