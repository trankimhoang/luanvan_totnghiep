<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';

    public $timestamps = false;

    public function Product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getImage(): string {
        if (!empty($this->image) && is_file(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('images/not_found.jpg');
    }
}
