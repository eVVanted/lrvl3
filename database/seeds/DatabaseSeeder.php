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
        $this->call(CategoriesTableSeeder::class);
        $this->call(FiltersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(PortfoliosTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
    }
}
