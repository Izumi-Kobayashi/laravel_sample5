<?php

use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
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
            'size' => 'S',
        ];

        DB::table('sizes')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'size' => 'M',
        ];

        DB::table('sizes')->insert($param);
        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'size' => 'L',
        ];

        DB::table('sizes')->insert($param);
    }
}
