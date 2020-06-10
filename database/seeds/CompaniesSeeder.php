<?php

use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Company::create([
            'name' => 'Empresa Admin'
        ]);

        \App\Models\Company::create([
            'name' => 'Empresa 1'
        ]);

        \App\Models\Company::create([
            'name' => 'Empresa 2'
        ]);
    }
}
