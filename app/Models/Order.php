<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function City(){
        return $this->belongsTo(City::class);
    }

    public function Products(){
        return $this->belongsToMany(
            Product::class,
            'order_products',
            'order_id',
            'product_id'
        )->withPivot(['quantity', 'price']);
    }

    public function total($isDiscount = true){
        $total = 0;

        foreach ($this->Products as $item) {
            $total += $item->pivot->quantity * $item->price;
        }

        if ($isDiscount) {
            $total -= $this->discount;
        }

        $total += $this->shipping_fee;
        return $total;
    }

    public function Coupon() {
        return $this->belongsTo(Coupon::class);
    }
}
