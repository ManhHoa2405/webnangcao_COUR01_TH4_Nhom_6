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
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/deli_burger.png.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Zero-Meat',
            'price' => '39000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/deli_burger_menu_web.png.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Bò Teriyaki',
            'price' => '45000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_bo.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Bulgogi',
            'price' => '49000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_bulgogi.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Ria Burger Cá',
            'price' => '40000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_ca.jpg.webp',
            'status' => 'available'
            ],   
            [
            'name' => 'Burger Double Double',
            'price' => '78000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_double.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Lchicken',
            'price' => '52000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_lchicken.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Mozzarella',
            'price' => '88000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_mozzarella.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Phô Mai',
            'price' => '47000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_phomai.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Ramen',
            'price' => '50000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_ramen.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Burger Tôm',
            'price' => '49000',
            'qualityStock' => '1000',
            'category' => 'Burger',
            'image_url' => 'products/burger_tom.jpg.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Gà Nướng (6 miếng)',
            'price' => '225000',
            'qualityStock' => '1000',
            'category' => 'Gà rán',
            'image_url' => 'products/ga_nuong.webp',
            'status' => 'available'
            ],
            [
            'name' => 'K-Chicken (6 miếng)',
            'price' => '225000',
            'qualityStock' => '1000',
            'category' => 'Gà rán',
            'image_url' => 'products/K-chicken.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Gà Sốt Đậu (6 miếng)',
            'price' => '225000',
            'qualityStock' => '1000',
            'category' => 'Gà rán',
            'image_url' => 'products/ga_sot_dau.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Gà Rán (6 miếng)',
            'price' => '225000',
            'qualityStock' => '1000',
            'category' => 'Gà rán',
            'image_url' => 'products/ga_ran.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Gà Sốt Phô Mai (6 miếng)',
            'price' => '225000',
            'qualityStock' => '1000',
            'category' => 'Gà rán',
            'image_url' => 'products/gasot_pho_mai.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Gà Sốt Gochu (6 miếng)',
            'price' => '225000',
            'qualityStock' => '1000',
            'category' => 'Gà rán',
            'image_url' => 'products/gasot_sochu.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Combo Burger Bò Teriyaki',
            'price' => '87000',
            'qualityStock' => '1000',
            'category' => 'Combo',
            'image_url' => 'products/Combo_bo_te.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Combo Burger Bulgogi',
            'price' => '91000',
            'qualityStock' => '1000',
            'category' => 'Combo',
            'image_url' => 'products/Combo_bulgogi.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Combo Burger LChicken',
            'price' => '94000',
            'qualityStock' => '1000',
            'category' => 'Combo',
            'image_url' => 'products/Combo_Lchicken.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Combo Burger Double Double',
            'price' => '120000',
            'qualityStock' => '1000',
            'category' => 'Combo',
            'image_url' => 'products/Combo_double.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Combo Burger Phô Mai',
            'price' => '89000',
            'qualityStock' => '1000',
            'category' => 'Combo',
            'image_url' => 'products/combo_phomai.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Combo Burger Ramen',
            'price' => '92000',
            'qualityStock' => '1000',
            'category' => 'Combo',
            'image_url' => 'products/combo_ramen.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Loking Set',
            'price' => '337000',
            'qualityStock' => '1000',
            'category' => 'Phần ăn nhóm',
            'image_url' => 'products/Loking_set.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Lony Set',
            'price' => '237000',
            'qualityStock' => '1000',
            'category' => 'Phần ăn nhóm',
            'image_url' => 'products/Loking_set.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Lody Set',
            'price' => '169000',
            'qualityStock' => '1000',
            'category' => 'Phần ăn nhóm',
            'image_url' => 'products/Lody_set.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Loy Set',
            'price' => '177000',
            'qualityStock' => '1000',
            'category' => 'Phần ăn nhóm',
            'image_url' => 'products/Loy_set.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Mì Ý',
            'price' => '43000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/myy.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Cơm Thịt Bò',
            'price' => '46000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/comthitbo.webp',
            'status' => 'available'
            ],
            [
                
            'name' => 'Cơm Teri LChicken',
            'price' => '46000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/terichicken.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Cơm Bò Trứng Phô Mai',
            'price' => '46000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/botrungphomai.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Cơm Gà Viên',
            'price' => '46000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/comgavien.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Cơm K-Chicken',
            'price' => '46000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/comK-chicken.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Cơm Gà Sốt Đậu',
            'price' => '46000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/comK-chicken.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Cơm Gà Sốt Phô Mai',
            'price' => '46000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/comgasotphomai.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Mỳ Ý Sốt Carbo Buldak',
            'price' => '49000',
            'qualityStock' => '1000',
            'category' => 'Cơm - Mì Ý',
            'image_url' => 'products/mycarbo.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Gà Nuggets',
            'price' => '40000',
            'qualityStock' => '1000',
            'category' => 'Thức ăn nhẹ',
            'image_url' => 'products/ganugget.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Mực Rán',
            'price' => '28000',
            'qualityStock' => '1000',
            'category' => 'Thức ăn nhẹ',
            'image_url' => 'products/mucran.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Gà lắc tuyết xanh',
            'price' => '44000',
            'qualityStock' => '1000',
            'category' => 'Thức ăn nhẹ',
            'image_url' => 'products/galactuyetxanh.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Gà lắc phô mai',
            'price' => '44000',
            'qualityStock' => '1000',
            'category' => 'Thức ăn nhẹ',
            'image_url' => 'products/galacphomai.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Khoai lắc phô mai',
            'price' => '35000',
            'qualityStock' => '1000',
            'category' => 'Thức ăn nhẹ',
            'image_url' => 'products/khoailacphomai.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Phô Mai Que',
            'price' => '36000',
            'qualityStock' => '1000',
            'category' => 'Thức ăn nhẹ',
            'image_url' => 'products/phomaique.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Milkis',
            'price' => '22000',
            'qualityStock' => '1000',
            'category' => 'Thức uống',
            'image_url' => 'products/Milkis.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Milo',
            'price' => '20000',
            'qualityStock' => '1000',
            'category' => 'Thức uống',
            'image_url' => 'products/Milo.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Pepsi Zero',
            'price' => '20000',
            'qualityStock' => '1000',
            'category' => 'Thức uống',
            'image_url' => 'products/pepsizoro.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Mirinda',
            'price' => '14000',
            'qualityStock' => '1000',
            'category' => 'Thức uống',
            'image_url' => 'products/mirinda.webp',
            'status' => 'available'
            ],
            [
            'name' => '7 up',
            'price' => '14000',
            'qualityStock' => '1000',
            'category' => 'Thức uống',
            'image_url' => 'products/7up.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Pepsi',
            'price' => '18000',
            'qualityStock' => '1000',
            'category' => 'Thức uống',
            'image_url' => 'products/pepsi.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Cà phê sữa dừa',
            'price' => '30000',
            'qualityStock' => '1000',
            'category' => 'Thức uống',
            'image_url' => 'products/caphesuudua.webp',
            'status' => 'available'
            ],
            [
            'name' => 'Cà phê Americano đá',
            'price' => '25000',
            'qualityStock' => '1000',
            'category' => 'Thức uống',
            'image_url' => 'products/americanoda.webp',
            'status' => 'available'
            ],
        ]);       
    }
}