<?php

namespace Database\Seeders;

use App\Models\AccountChartsType;
use Illuminate\Database\Seeder;

class AccountChartsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountChartsType::create([
            'type' => 'Assets'
        ]);
        AccountChartsType::create([
            'type' => 'Liabilities And Credit Cards'
        ]);
        AccountChartsType::create([
            'type' => 'Income'
        ]);
        AccountChartsType::create([
            'type' => 'Expenses'
        ]);
        AccountChartsType::create([
            'type' => 'Equity'
        ]);
    }
}
