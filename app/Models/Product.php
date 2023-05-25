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
        'description',
        'price',
        'price_new',
        'quantity',
        'image',
        'status',
        'category_id'
    ];

    public function listProductChild() {
        return $this->hasMany(Product::class, 'parent_id')->with(['listAttribute']);
    }

    public function attributeTitle() {
        $listAttr = $this->listAttribute;
        $title = '';

        foreach ($listAttr as $key => $attr) {
            if ($key == 0) {
                $title .= $attr->pivot->text_value;
            } else {
                $title .= ' - ' . $attr->pivot->text_value;
            }
        }

        return $title;
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

    public function Category() {
        return $this->belongsTo(Category::class);
    }

    public function listImage() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
