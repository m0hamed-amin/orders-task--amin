<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('ingredients')->insert([
            'id' => 1,
            'product_id' => 1,
            'ingredient_name' => 'Beef',
            'quantity' => 150,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('ingredients')->insert([
            'id' => 2,
            'product_id' => 1,
            'ingredient_name' => 'Cheese',
            'quantity' => 30,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('ingredients')->insert([
            'id' => 3,
            'product_id' => 1,
            'ingredient_name' => 'Onion',
            'quantity' => 20,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
