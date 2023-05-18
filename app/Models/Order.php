<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order';

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'note',
        'status',
        'payment_method'
    ];

    public function order_payment_methods()
    {
        return $this->hasMany(OrderPaymentMethod::class, 'order_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
