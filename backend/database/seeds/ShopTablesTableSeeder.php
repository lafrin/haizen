<?php

use Illuminate\Database\Seeder;

class ShopTablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_tables')->insert([
            [
                'id' => '1',
                'id_hash' => '$2y$10$ZNzk.oEUQDTGpHK9987JQObnP/MTojfTZnC6DpZulroOUenQUtyQO	',
                'table_name' => 'a-01',
                'shop_id' => '1',
                'status' => '1',
                'max_people' => '3',
                'is_display' => '1',
            ],
            [
                'id' => '2',
                'id_hash' => '$2y$10$6MfhzBI/kD9j9Gxb3Ydxa.HZDrcBLIrDBQkVxFoaynHiVoc4MhjzC',
                'table_name' => 'a-02',
                'shop_id' => '1',
                'status' => '2',
                'max_people' => '34',
                'is_display' => '1',
            ],
            [
                'id' => '3',
                'id_hash' => '$2y$10$HOpdLeIVC33zAw83JkAewOFlln5NR653AtTs31MfCs6wGdPN1ADw6',
                'table_name' => 'cc-05',
                'shop_id' => '1',
                'status' => '4',
                'max_people' => '4',
                'is_display' => '1',
            ],
            [
                'id' => '4',
                'id_hash' => '$2y$10$B/q3pr6otbrifa3JFjxUju7FNUDwruZwgA.qsc7qQNaIdcsK.G1G2',
                'table_name' => 'jaadf-05',
                'shop_id' => '1',
                'status' => '9',
                'max_people' => '1',
                'is_display' => '1',
            ],
        ]);
    }
}
