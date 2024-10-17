<?php

namespace Database\Seeders;

use App\Models\EggPrice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EggPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $costumers = User::where('level', '3')->get();
        foreach ($costumers as $item) {
            EggPrice::create([
                'user_id'       => $item->id,
                'big'           => 44500,
                'small'         => 34000,
                'broken'        => 0,
            ]);
        }

        $buyers = User::where('level', '5')->get();
        foreach ($buyers as $buyer) {
            EggPrice::create([
                'user_id'       => $buyer->id,
                'big'           => 46000,
                'small'         => 34000,
                'broken'        => 0,
            ]);
        }
    }
}
