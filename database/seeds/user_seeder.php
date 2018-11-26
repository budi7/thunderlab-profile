<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user['username'] = "budi-purnomo@outlook.com";
        $user['password'] = 'admin';
        $user['role'] = 'admin';
        $user->save();
    }
}
