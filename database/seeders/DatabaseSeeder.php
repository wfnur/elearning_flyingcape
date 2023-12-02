<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();

        DB::table('user_types')->insert([
            'name' => 'Teacher',
            'description' => 'Teacher Description',
        ]);

        DB::table('user_types')->insert([
            'name' => 'Student',
            'description' => 'Student Description',
        ]);
    }
}
