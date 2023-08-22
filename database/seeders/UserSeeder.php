<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Test manager 2',
            'email' => 'user@gmail.com',
            'email_verified_at' => Carbon::now(),
             #password => testing@123# ,
            'password' => '$2a$04$cww9LddZNvoeCVBU6EbI1edno7.assWdn5R4QoY0M5.2F7jf1wtSq',  //123456
        ]);

    }
}
