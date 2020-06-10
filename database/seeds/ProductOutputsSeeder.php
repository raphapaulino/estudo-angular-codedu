<?php

use App\Models\ProductOutput;
use Illuminate\Database\Seeder;

class ProductOutputsSeeder extends Seeder
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
        factory(ProductOutput::class, 150)
            ->make()
            ->each(function (ProductOutput $output) use ($products) {
                $tenantId = rand(1, 3);
                $product = $products->where(\Tenant::getTenantField(), $tenantId)->random();
                $output->product_id = $product->id;
                $output->company_id = $tenantId;
                $output->save();
            });
    }
}
