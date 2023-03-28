<?php

namespace Database\Seeders;

use App\Models\FranchiseWorkingHours;
use App\Models\OrderProductItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            optionSeeder::class,
            CategorySeeder::class,
            FaqSeeder::class,
            FranchiseSeeder::class,
            FranchiseWorkingSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
            promotionSeeder::class,
            ModifierSeeder::class,
            ProductModifierSeeder::class,
            OrderProductSeeder::class,
            RefundSeeder::class,
            CardSeeder::class,
            OrderProductItemSeeder::class,
        ]);
    }
}
