<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Admin',
            'type' => 1,
            'status' => 'Active',
            'email_verification' =>1,
            'hash_number' => md5('John Doe'),
            'created_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
