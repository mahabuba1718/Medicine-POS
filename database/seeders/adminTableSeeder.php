<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
        [
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'role_id'=> 1,
            'password'=> Hash::make('admin1234'),
            'status' => 1,

        ]
        );
        Setting::create([
            'sitename'=>'Medicine POS',
            'pharmacyname'=>'Medicine Shop',
            'email'=>'pharmacy@gmail.com',
            'phone'=>'123456789',
            'address'=>'Address',
            'logo' => 'medi.png',
            'favicon' => 'Pill.png'
        ]);
    //    DB::table('admin')->insert(
    //     [
    //         'name'=>'admin2',
    //         'email'=>'admin2@gmail.com',
    //         'password'=>bcrypt('admin2@gmail.com'),

    //     ]

    //    );
    }
}
