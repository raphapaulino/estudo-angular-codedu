<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Tenant::setTenant(Company::find(1));
        factory(\App\Models\Category::class, 20)->create();

        \Tenant::setTenant(Company::find(2));
        factory(\App\Models\Category::class, 20)->create();

        \Tenant::setTenant(Company::find(3));
        factory(\App\Models\Category::class, 20)->create();
    }
}
