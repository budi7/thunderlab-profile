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
        // $user['role'] = json_encode([
        //     'administrasi' => [
        //         'c', 'r', 'u', 'd'
        //     ],
        //     'produk' => [
        //         'c', 'r', 'u', 'd'
        //     ],
        //     'pesanan' => [
        //         'c', 'r', 'u', 'd'                
        //     ],
        //     'gudang' => [
        //         'c', 'r', 'u', 'd'                
        //     ]
        // ]);
        $user['password'] = 'admin';
        $user->save();
    }
}
