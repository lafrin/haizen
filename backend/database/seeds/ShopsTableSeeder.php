<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'shop_name' => 'haya',
            'email' => 'test@gmail.com',
            'password' => '$2y$10$VFWto3BxgMGRTxEdV5qOae1fj2TRS7K6IatOM8cWB90wxGLULJ9yG	',
        ]);
    }
}
