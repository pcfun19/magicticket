<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => '$2y$10$px3jxoKycY6pudONGiQereb3lZGPTCNrnfuB0RLePyDDsTp.jkTgi',
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2020-05-01 14:06:43',
                'verification_token' => '',
                'business_name'      => '',
            ],
        ];

        User::insert($users);

    }
}
