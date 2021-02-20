<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DebtLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'user_id',
        'user_name',
        'debt_id',
        'debt_name',
        'debt_amount',
        'paid_amount',
        'debt_old_status',
        'debt_new_status'
    ];
}
