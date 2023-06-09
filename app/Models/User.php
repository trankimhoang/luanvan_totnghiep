<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function listProductInCart(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Product::class, 'carts', 'user_id', 'product_id')->withPivot(['quantity']);
    }

    public function countListProductInCart() {
        return $this->listProductInCart->sum('pivot.quantity');
    }

    public function totalMoneyInCart() {
        $total = 0;

        foreach ($this->listProductInCart as $item) {
            $total += $item->pivot->quantity * $item->price;
        }

        return $total;
    }

    public function orders(){
        return $this->hasMany(Order::class, 'user_id');
    }
}
