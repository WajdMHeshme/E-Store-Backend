<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    protected $fillable = [
        'name',
        'delivery_fee',
        'is_active'
    ];
}
