<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'vehicle_name',
        'user_id',
        'reg_no',
        'type',
        'description',
        'make',
        'year',
        'model',
        'condition'
    ];

}
