<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('menus')->insert([
            ['name' => 'Thức uống', 'image' => 'nuocuong.png'],
            ['name' => 'Thức ăn nhẹ', 'image' => 'thucannhe.jpg'],
            ['name' => 'Cơm - Mì Ý', 'image' => 'comvamy.jpg'],
            ['name' => 'Phần ăn nhóm', 'image' => 'phanannhom.jpg'],
            ['name' => 'Combo', 'image' => 'burger_combo.jpg'],
            ['name' => 'Gà rán', 'image' => 'garan.jpg'],
            ['name' => 'Burger', 'image' => 'burger.jpg'],
        ]);
    }
}
