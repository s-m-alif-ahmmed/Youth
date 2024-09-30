<?php

namespace App\Models\Website;

use App\Models\Admin\Coupon;
use App\Models\Admin\DeliveryTax;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'delivery_tax_id',
        'coupon_id',
        'discount_amount',
        'istimate_total',
        'order_total',
        'name',
        'address',
        'city',
        'postal_code',
        'number',
        'status',
        'note',
        'all_terms',
        'tracking_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define the relationship with the delivery tax id model
    public function deliveryTax()
    {
        return $this->belongsTo(DeliveryTax::class, 'delivery_tax_id');
    }

    // Define the relationship with the User model
    public function coupons()
    {
        return $this->belongsTo(Coupon::class);
    }

    // Define the relationship with the OrderDetail model
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
