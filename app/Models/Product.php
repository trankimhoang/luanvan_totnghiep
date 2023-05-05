<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
      'name',
      'price',
      'quantity',
      'parent_id'
    ];

    public function listProductChild() {
        return $this->hasMany(Product::class, 'parent_id')->with(['listAttribute']);
    }

    public function listAttribute() {
        return $this->belongsToMany(
            Attribute::class,
            'values',
            'product_id',
            'attribute_id'
        )->withPivot('text_value');
    }

    public function getImage(): string {
        if (!empty($this->image) && is_file(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('images/not_found.jpg');
    }
}
