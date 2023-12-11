<?php

namespace Database\Seeders;

use App\Models\UserIdentity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserIdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserIdentity::factory()->create([
            'id'=>1,
            'email'=>'sdjksjdkjsd',
            'password'=>'huy',
            'first_name'=>"hjhjh",
            'role'=>"hhhhh"
            ]);
    }
}
