<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = User::all();

        $user = $users->first();

        $user_id = $user->id;

        //获取去除掉 id卫1 的所有用户数组

        $followers = $users->slice(1);

        $follower_ids =  $followers->pluck('id')->toArray();


        //除了1号用户意外的所有用户

        $user->follow($follower_ids);

        //所有的用户都关注1号
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
