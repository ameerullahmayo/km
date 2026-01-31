<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_number', 'total_price', 'status', 'discount',
        'tax', 'shipping_status', 'order_status', 'payment_status', 'shipping_cost',
        'payment_method', 'transaction_id', 'card_type', 'card_last_four', 'card_expiry',
        'billing_address', 'billing_city', 'billing_country', 'billing_postal_code',
        'shipping_address', 'shipping_city', 'shipping_state', 'shipping_country', 'shipping_postal_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public static function userOrders($id)
    {
        return self::with('orderProducts')
            ->where('user_id', $id)
            ->latest()
            ->get();
    }
}
