<?php

namespace Database\Seeders;

use App\Models\AccountChartsCategory;
use Illuminate\Database\Seeder;

class AccountChartsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountChartsCategory::create([
            'type' => 'Assets',
            'category' => 'Cash And Bank'
        ]);
        AccountChartsCategory::create([
            'type' => 'Assets',
            'category' => 'Money In Transit'
        ]);
        AccountChartsCategory::create([
            'type' => 'Assets',
            'category' => 'Inventory'
        ]);
        AccountChartsCategory::create([
            'type' => 'Assets',
            'category' => 'Property, Plant, Equipment'
        ]);
        AccountChartsCategory::create([
            'type' => 'Assets',
            'category' => 'Other Long-Term Assets'
        ]);
        AccountChartsCategory::create([
            'type' => 'Liabilities And Credit Cards',
            'category' => 'Other Long-Term Liability'
        ]);
        AccountChartsCategory::create([
            'type' => 'Liabilities And Credit Cards',
            'category' => 'Loans And Lines OF Credit'
        ]);
        AccountChartsCategory::create([
            'type' => 'Liabilities And Credit Cards',
            'category' => 'Expected Payments To Vendors'
        ]);
        AccountChartsCategory::create([
            'type' => 'Income',
            'category' => 'Income'
        ]);
        AccountChartsCategory::create([
            'type' => 'Expenses',
            'category' => 'Operating Expenses'
        ]);
        AccountChartsCategory::create([
            'type' => 'Expenses',
            'category' => 'Cost Of Goods Sold'
        ]);
        AccountChartsCategory::create([
            'type' => 'Expenses',
            'category' => 'Payroll Expenses'
        ]);
        AccountChartsCategory::create([
            'type' => 'Equity',
            'category' => 'Business Owner Contribution And Drawing'
        ]);
        AccountChartsCategory::create([
            'type' => 'Equity',
            'category' => 'Retained Earnings: Profit'
        ]);

    }
}
