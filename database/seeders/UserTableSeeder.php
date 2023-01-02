<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'    =>  'Ezequiel',
            'last_name'     =>  'Gonzalez Garcia',
            'username'      =>  'exeexegg',
            'email'         =>  'exeeexeg@gmail.com',
            'password'      =>  Hash::make('admin')
        ]);
    }
}
