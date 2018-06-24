<?php

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
        // $this->call(UsersTableSeeder::class);
        DB::table('items')->insert([
        	[
            'name' => 'Espresso',
            'price' => '2000',
            'is_itemset' => '0',
            ],
            [
            'name' => 'Blueberry Muffin',
            'price' => '2000',
            'is_itemset' => '0',
            ],
            [
            'name' => 'Cafe Latte',
            'price' => '3000',
            'is_itemset' => '0',
            ],
            [
            'name' => 'Extra Hot',
            'price' => '10000',
            'is_itemset' => '0',
            ],
            [
            'name' => 'Upsize',
            'price' => '5000',
            'is_itemset' => '0',
            ],
        ]);
    }
}
