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
            'password' => 'ken',
            'gender' => 'male',
        ];

        DB::table('users')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'name' => 'tanaka',
            'email' => 'ai_tanaka@yahoo.com',
            'password' => 'ai',
            'gender' => 'female',
        ];

        DB::table('users')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'name' => 'suzuki',
            'email' => 'yoko_suzuki@yahoo.com',
            'password' => 'yoko',
            'gender' => 'female',
        ];

        DB::table('users')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'name' => 'sato',
            'email' => 'taro_sato@yahoo.com',
            'password' => 'taro',
            'gender' => 'male',
        ];

        DB::table('users')->insert($param);
    }
}
