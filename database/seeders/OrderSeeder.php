<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // $this->addOrderWithOutOrm();
        $this->addOrderWithOrm();
    }


    private function addOrderWithOutOrm()
    {
        $userIdList = DB::table('users')->select('id')->get();
        foreach ($userIdList as $user) {
            foreach (range(1, 10) as $step) {
                DB::table('orders')->insert(['user_id' => $user->id]);
            }
        }
    }

    private function addOrderWithOrm()
    {
        $userList = User::all();
        foreach ($userList as $user) {
            foreach (range(1, 10) as $step) {
                Order::create(['user_id'=>$user->id]);
            }
        }
    }
}
