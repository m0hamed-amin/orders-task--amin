<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('stock')->insert([
            'ingredient_id' => 1 ,
            'ingredient_name'=> 'Beef',
            'quantity'=> 20000,
            'created_at' =>  Carbon::now(),
            'updated_at' =>  Carbon::now(),
        ]);

        DB::table('stock')->insert([
            'ingredient_id' => 2 ,
            'ingredient_name'=> 'Cheese',
            'quantity'=> 5000,
            'created_at' =>  Carbon::now(),
            'updated_at' =>  Carbon::now(),
        ]);

        DB::table('stock')->insert([
            'ingredient_id' => 3 ,
            'ingredient_name'=> 'Onion',
            'quantity'=> 1000,
            'created_at' =>  Carbon::now(),
            'updated_at' =>  Carbon::now(),
        ]);
    }
}
