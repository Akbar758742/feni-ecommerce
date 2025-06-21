<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $user=new User();
         $user->name='Admin';
         $user->email='admin@example.com';
         $user->password=Hash::make('123');
         $user->save();

        //  DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' =>'admin@example.com',
        //     'password' => Hash::make('123'),
        // ]);
    }
}
