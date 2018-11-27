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
        User::truncate();

        $user = new User;
        $user['name'] = "Budi Purnomo";
        $user['username'] = "budi-purnomo@outlook.com";
        $user['password'] = 'admin123';
        $user['role'] = 'admin';
        if(!$user->save()){
            dd($user->getErrors());
        }
    }
}
