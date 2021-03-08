<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'oem',
        'model_no',
        'product_type',
        'price',
        'config',
    ];

}
