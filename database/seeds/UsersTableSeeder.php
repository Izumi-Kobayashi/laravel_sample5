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
        //
        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'name' => 'suzuki',
            'email' => 'ken_suzuki@yahoo.com',
            'password' => \Hash::make('ken'),
            'gender' => 'male',
        ];

        DB::table('users')->insert($param);
    }
}
