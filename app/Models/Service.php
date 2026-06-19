<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'delivery_time',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}