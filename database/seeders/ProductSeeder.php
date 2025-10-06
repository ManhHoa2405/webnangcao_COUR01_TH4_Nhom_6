<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \DB::table('Products')->insert([
            [
            'name' => 'Burger Tôm Sốt Carbo Buldak',
            'price' => '49000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/deli_burger.png.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Zero-Meat',
            'price' => '39000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/deli_burger_menu_web.png.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Bò Teriyaki',
            'price' => '45000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_bo.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Bulgogi',
            'price' => '49000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_bulgogi.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Ria Burger Cá',
            'price' => '40000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_ca.jpg.webp',
            'status' => 'available'
            ],   
            [
            'name' => 'Burger Double Double',
            'price' => '78000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_double.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Lchicken',
            'price' => '52000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_lchicken.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Mozzarella',
            'price' => '88000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_mozzarella.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Phô Mai',
            'price' => '47000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_phomai.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Ramen',
            'price' => '50000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_ramen.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Tôm',
            'price' => '49000',
            'qualityStock' => '200',
            'category' => 'Burger',
            'image_url' => 'products/burger_tom.jpg.webp',
            'status' => 'available'
            ],
        ]);       
    }
}
