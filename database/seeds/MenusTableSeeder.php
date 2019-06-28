<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('menus')->insert([
            [
                'title' => 'Главная',
                'path' => 'http://larvl3.loc',
                'parent' => '0'
            ],

            [
                'title' => 'Блог',
                'path' => 'http://larvl3.loc/articles',
                'parent' => '0'
            ],

            [
                'title' => 'Компьютеры',
                'path' => 'http://larvl3.loc/articles/cat/computers',
                'parent' => '2'
            ],

            [
                'title' => 'Интересное',
                'path' => 'http://larvl3.loc/articles/cat/iteresting',
                'parent' => '2'
            ],

            [
                'title' => 'Советы',
                'path' => 'http://larvl3.loc/articles/cat/soveti',
                'parent' => '2'
            ],

            [
                'title' => 'Портфолио',
                'path' => 'http://larvl3.loc/portfolios',
                'parent' => '0'
            ],

            [
                'title' => 'Контакты',
                'path' => 'http://larvl3.loc/contacts',
                'parent' => '0'
            ],

        ]);
    }
}
