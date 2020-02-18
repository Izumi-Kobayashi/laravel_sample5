<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'name' => 'user1',
            'email' => 'user1@test.com',
            'password' => \Hash::make('user1'),
            'gender' => 'male',
        ];

        DB::table('users')->insert($param);
    }
}
