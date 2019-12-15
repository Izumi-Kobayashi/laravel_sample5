<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
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
            'name' => 'kobayashi',
            'email' => 'izumi_kobayashi@yahoo.com',
            'password' => Hash::make('izumi'),
        ];

        DB::table('admins')->insert($param);
    }
}
