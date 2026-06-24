<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProgress extends Model
{
    protected $table = 'order_progresses';

    protected $fillable = [
        'order_id',
        'phase',
        'image',
        'artist_note',
        'status',
        'customer_note',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}