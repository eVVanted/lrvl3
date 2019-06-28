<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            [
                'title' => 'Блог',
                'alias' => 'blog',
            ],
            [
                'title' => 'Компьютеры',
                'alias' => 'computers',
                'parent_id'=>'1'
            ],
            [
                'title' => 'Интересное',
                'alias' => 'iteresting',
                'parent_id'=>'1'
            ],
            [
                'title' => 'Советы',
                'alias' => 'soveti',
                'parent_id'=>'1'
            ],

        ]);
    }
}
