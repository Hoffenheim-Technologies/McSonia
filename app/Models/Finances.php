<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finances extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'account',
        'beneficiary',
        'payment_type',
        'payment_category',
        'category',
        'details',
        'description',
        'amount',
        'transaction_date'
    ];
}
