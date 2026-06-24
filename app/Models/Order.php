<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'service_id',
        'status',
        'description',
        'reference_image',
        'result_image',
        'rating',
        'review',
        'due_date',
        'revision_requested',
        'revision_note',
        'revision_count'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function progresses()
    {
        return $this->hasMany(OrderProgress::class);
    }
}