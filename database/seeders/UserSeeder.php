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
          $user->email_verified_at=date('Y-m-d H:i:s');
         $user->save();

          $user=new User();
         $user->name='customer';
         $user->email='customer@example.com';
         $user->password=Hash::make('123');
         $user->user_type='customer';
         $user->email_verified_at=date('Y-m-d H:i:s');
         $user->save();


        //  DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' =>'admin@example.com',
        //     'password' => Hash::make('123'),
        // ]);
    }
}
