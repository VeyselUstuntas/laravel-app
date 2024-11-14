<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $this->withOutOrm();
    }

    private function withOrm() {}

    private function withOutOrm()
    {
        DB::table('products')->delete();
        $users = DB::table('products')->insert($this->prodcutModel());
    }

    private function prodcutModel()
    {
        return [
            [
                'name' => 'Thinkpad E14',
                'price' => 22000,
            ],
            [
                'name' => 'Asus Vivabook',
                'price' => 21000,
            ],
            [
                'name' => 'iphone 13',
                'price' => 30000,
            ],
            [
                'name' => 'iphone 14',
                'price' => 35000,
            ],
            [
                'name' => 'iphone 15',
                'price' => 40000,
            ],
            [
                'name' => 'Logitech MX key',
                'price' => 14000,
            ],
            [
                'name' => 'Monster Huma',
                'price' => 29000,
            ],
            [
                'name' => 'samsung s23',
                'price' => 27000,
            ],
            [
                'name' => 'samsung s24',
                'price' => 32000,
            ],

        ];
    }
}
