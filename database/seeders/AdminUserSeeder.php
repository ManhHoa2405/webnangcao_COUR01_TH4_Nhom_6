<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::updateOrCreate(
            ['email' => 'hiangfood@gmail.com'],
            [
                'name' => 'Hiang',
                'phone'=> '0989888888',
                'password' => Hash::make('0989888888'), //pass
                'role' => 'admin', //phan quyen
            ]
        );
    }
}
