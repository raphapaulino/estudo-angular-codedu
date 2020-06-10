<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Tenant::setTenant(null); // para poder consultar todas as categorias abaixo
        $categories = \App\Models\Category::all();
        factory(Product::class, 200)
            ->make()
            ->each(function (Product $product) use ($categories) {
                $tenantId = rand(1, 3);
                $category = $categories->where(\Tenant::getTenantField(), $tenantId)->random();
                $product->company_id = $tenantId;  //1
                // \Tenant::setTenant(\App\Models\Company::find($tenantId)); // poderia ser dessa outra forma, mas é preciso acessar o banco
                $product->save();
                $product->categories()->attach($category); //2
            });
    }
}
