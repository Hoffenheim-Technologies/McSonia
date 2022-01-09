<?php

namespace App\Services\Account;

use App\Models\User;
use App\Models\Finances;
use Carbon\Carbon;

class FinanceService
{
    public static function log($account, $beneficiary, $payment_type, $payment_category, $category, $details, $description, $amount, $transaction_date = null)
    {
        $payload = [
            "reference" => getRandomToken(6),
            "account" => $account,
            "beneficiary" => $beneficiary,
            "payment_type" => $payment_type,
            "description" => $description,
            "amount" => $amount,
            "payment_category" => $payment_category,
            "category" => $category,
            "details" => $details,
            "transaction_date" => $transaction_date ?? Carbon::Now()
        ];

        return  Finances::create($payload);
    }

}
