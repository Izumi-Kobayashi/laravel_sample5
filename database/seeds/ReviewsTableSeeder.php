<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
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
            'menu_id' => 1,
            'text' => '果肉たっぷりのオレンジジュースです！',
            'user_id' => 1,
        ];

        DB::table('reviews')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'menu_id' => 3,
            'text' => '具がゴロゴロしていてとてもおいしいです',
            'user_id' => 1,
        ];

        DB::table('reviews')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'menu_id' => 2,
            'text' => '香りがいいです',
            'user_id' => 2,
        ];

        DB::table('reviews')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'menu_id' => 4,
            'text' => 'ソースが絶品です。また食べたい。',
            'user_id' => 2,
        ];

        DB::table('reviews')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'menu_id' => 1,
            'text' => '普通のジュース',
            'user_id' => 3,
        ];

        DB::table('reviews')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'menu_id' => 3,
            'text' => '値段の割においしいカレーだと思いました',
            'user_id' => 3,
        ];

        DB::table('reviews')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'menu_id' => 2,
            'text' => '苦味がちょうどよくて、おすすめです',
            'user_id' => 4,
        ];

        DB::table('reviews')->insert($param);

        $param = [
            'created_at' => date("Y-m-d H:i:s"),
            'menu_id' => 4,
            'text' => '具材にこだわりを感じました。',
            'user_id' => 4,
        ];

        DB::table('reviews')->insert($param);
    }

}
