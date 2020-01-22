<?php

use Illuminate\Database\Seeder;

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
            'name' => 'Mohammed Jacksi',
            'username' => 'mohjacksi',
            'email' => 'moh.jacksi@yahoo.com',
            'password' => Hash::make('123123'),
        ]);
    }
}
