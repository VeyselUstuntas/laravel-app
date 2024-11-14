<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->withOutOrm();
    }

    private function withOrm() {}

    private function withOutOrm()
    {
        DB::table('users')->delete();
        $users = DB::table('users')->insert($this->userModel());
    }

    private function userModel()
    {
        return [
            [
                'name' => 'Kullanıcı 1',
                'surname' => 'Kullanıcı 1',
                'email' => 'kullanici1@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 2',
                'surname' => 'Kullanıcı 2',
                'email' => 'kullanici2@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 3',
                'surname' => 'Kullanıcı 3',
                'email' => 'kullanici3@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 4',
                'surname' => 'Kullanıcı 4',
                'email' => 'kullanici4@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 5',
                'surname' => 'Kullanıcı 5',
                'email' => 'kullanici5@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 6',
                'surname' => 'Kullanıcı 6',
                'email' => 'kullanici6@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 7',
                'surname' => 'Kullanıcı 7',
                'email' => 'kullanici7@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 8',
                'surname' => 'Kullanıcı 8',
                'email' => 'kullanici8@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 9',
                'surname' => 'Kullanıcı 9',
                'email' => 'kullanici9@hotmail.com',
                'password' => Hash::make("123")
            ],
            [
                'name' => 'Kullanıcı 10',
                'surname' => 'Kullanıcı 10',
                'email' => 'kullanici10@hotmail.com',
                'password' => Hash::make("123")
            ],
        ];
    }
}
