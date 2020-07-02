<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'Sport'
        ]);
        DB::table('tags')->insert([
            'name' => 'Health'
        ]);

        DB::table('tags')->insert([
            'name' => 'Economie'
        ]);

        DB::table('tags')->insert([
            'name' => 'Programing'
        ]);
        DB::table('tags')->insert([
            'name' => 'Angular'
        ]);
        DB::table('tags')->insert([
            'name' => 'Laravel'
        ]);
    }
}
