<?php

namespace App\Services\Payment;

use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionService
{

    // protected $fillable = ['user_id','user_email','reference','gateway','description','amount','status'];

    public static function log($user_id, $user_email, $reference, $gateway, $description, $amount, $status)
    {
        $payload = [
            "user_id" => $user_id,
            "user_email" => $user_email,
            "reference" => $reference,
            "gateway" => $gateway,
            "description" => $description,
            "amount" => $amount,
            "status" => $status
        ];

        return  Transaction::create($payload);
    }

}
