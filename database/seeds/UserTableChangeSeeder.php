<?php
use App\User;
use Illuminate\Database\Seeder;

class UserTableChangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::where('id', 1)->update(['password' => \Hash::make('ken')]);
        User::where('id', 2)->update(['password' => \Hash::make('ai')]);
        User::where('id', 3)->update(['password' => \Hash::make('taro')]);
        User::where('id', 4)->update(['password' => \Hash::make('yoko')]);
    }
}
