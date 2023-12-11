<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserIdentity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        UserIdentity::factory()->create([
            'id'=>1,
            'email'=>'sdjksjdkjsd',
            'password'=>'huy',
            'first_name'=>"hjhjh",
            'role'=>"hhhhh"
        ]);

    }
}
