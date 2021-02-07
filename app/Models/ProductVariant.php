<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable= [
        'product_id',
        'variant',
        'buying_price',
        'selling_price_per_unit',
        'buying_date',
        'stock'
    ];
}
