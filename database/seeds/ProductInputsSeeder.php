<?php

use App\Models\ProductInput;
use Illuminate\Database\Seeder;

class ProductInputsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Tenant::setTenant(null); // para poder consultar todos os produtos abaixo
        $products = \App\Models\Product::all();
        factory(ProductInput::class, 200)
            ->make()
            ->each(function (ProductInput $input) use ($products) {
                $tenantId          = rand(1, 3);
                $product           = $products->where(\Tenant::getTenantField(), $tenantId)->random();
                $input->product_id = $product->id;
                $input->company_id = $tenantId;
                $input->save();
            });
    }
}
