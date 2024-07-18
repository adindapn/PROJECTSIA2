<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::create([
            'name'=> 'admin',                       
            'email'=>'admin@test.com',
            'password'=>bcrypt('password')
        ]);
        $admin->assignRole('admin');
            
        $user=User::create([
            'name'=> 'user',
            'email'=>'user@test.com',
            'password'=>bcrypt('password')
        ]);
        $user->assignRole('user');
    }
}
