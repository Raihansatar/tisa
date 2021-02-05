<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValueModel extends Model
{
    use HasFactory;

    protected $fillable= [
        'option_id',
        'name',
    ];
}
