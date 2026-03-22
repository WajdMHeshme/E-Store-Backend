<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title',
        'image',
        'link',
        'is_active',
        'expires_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
