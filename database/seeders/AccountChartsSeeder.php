<?php

namespace Database\Seeders;

use App\Models\AccountCharts;
use Illuminate\Database\Seeder;

class AccountChartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AccountCharts::create([
            'type' => 'Assets',
            'category' => 'Cash And Bank',
            'account' => 'Cash On Hand'
        ]);
        AccountCharts::create([
            'type' => 'Assets',
            'category' => 'Cash And Bank',
            'account' => 'Cash In Bank'
        ]);
        AccountCharts::create([
            'type' => 'Assets',
            'category' => 'Other Long-term Asset',
            'account' => 'Long-term Assets'
        ]);
        AccountCharts::create([
            'type' => 'Assets',
            'category' => 'Inventory',
            'account' => 'Purchase Of Inventory'
        ]);
        AccountCharts::create([
            'type' => 'Assets',
            'category' => 'Property, Plant, Equipment',
            'account' => 'Land Purchase'
        ]);
        AccountCharts::create([
            'type' => 'Liabilities And Credit Cards',
            'category' => 'Other Long-Term Liability',
            'account' => 'Long-term Liability'
        ]);
        AccountCharts::create([
            'type' => 'Liabilities And Credit Cards',
            'category' => 'Loans And Lines OF Credit',
            'account' => 'Loans'
        ]);
        AccountCharts::create([
            'type' => 'Liabilities And Credit Cards',
            'category' => 'Expected Payments To Vendors',
            'account' => 'Accounts Payable'
        ]);
        AccountCharts::create([
            'type' => 'Income',
            'category' => 'Income',
            'account' => 'Sales'
        ]);
        AccountCharts::create([
            'type' => 'Expenses',
            'category' => 'Operating Expenses',
            'account' => 'Inventory'
        ]);
        AccountCharts::create([
            'type' => 'Expenses',
            'category' => 'Cost Of Goods Sold',
            'account' => 'Labour'
        ]);
        AccountCharts::create([
            'type' => 'Expenses',
            'category' => 'Payroll Expenses',
            'account' => 'Payroll - Salary & Wages'
        ]);
        AccountCharts::create([
            'type' => 'Equity',
            'category' => 'Business Owner Contribution And Drawing',
            'account' => 'Owner Investment / Drawings'
        ]);
        AccountCharts::create([
            'type' => 'Equity',
            'category' => 'Business Owner Contribution And Drawing',
            'account' => 'Shareholder Investment / Drawings'
        ]);
        AccountCharts::create([
            'type' => 'Equity',
            'category' => 'Retained Earnings: Profit',
            'account' => 'Owners Equity'
        ]);
    }
}
