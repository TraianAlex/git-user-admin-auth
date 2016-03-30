<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //factory(Admin::class, 1)->create();
        factory(Category::class, 3)->create();
    }
}
