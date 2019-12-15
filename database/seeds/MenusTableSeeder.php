<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
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
            'type' => 'Drink',
            'name' => 'JUICE',
            'price' => 600,
            'image' => 'https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/juice.png',
            'drink_type' => 'アイス',
            'spiciness' => '',
        ];

        DB::table('menus')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'type' => 'Drink',
            'name' => 'COFFEE',
            'price' => 500,
            'image' => 'https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/coffee.png',
            'drink_type' => 'ホット',
            'spiciness' => '',
        ];

        DB::table('menus')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'type' => 'Food',
            'name' => 'CARRY',
            'price' => 900,
            'image' => 'https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/curry.png',
            'drink_type' => '',
            'spiciness' => 3,
        ];

        DB::table('menus')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'type' => 'Food',
            'name' => 'PASTA',
            'price' => 1200,
            'image' => 'https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/pasta.png',
            'drink_type' => '',
            'spiciness' => 1,
        ];

        DB::table('menus')->insert($param);
    }
}
