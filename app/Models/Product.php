<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 */
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
        'category_id',
        'type'
    ];

    public function listProductChild(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Product::class, 'parent_id')->with(['listAttribute']);
    }

    public function Parent() {
        return $this->belongsTo(Product::class);
    }

    public function getName() {
        if (empty($this->parent_id)) {
            return $this->getAttribute('name');
        }

        return $this->Parent->name . ' [' . $this->attributeTitle() . ']';
    }

    public function attributeTitle(): string {
        $listAttr = $this->listAttribute;
        $title = '';

        foreach ($listAttr as $key => $attr) {
            if ($key == 0) {
                $title .= $attr->name . ': ' . $attr->pivot->text_value;
            } else {
                $title .= ' - ' .  $attr->name . ': ' . $attr->pivot->text_value;
            }
        }

        return $title;
    }

    public function listAttribute(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
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

    public function Category(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function listImage(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function getArrayAttrIds($isPrivate = 0): array {
        return $this->belongsToMany(
            Attribute::class,
            'product_attr_config',
            'product_id',
            'attribute_id'
        )->where('product_attr_config.is_private', '=', $isPrivate)
            ->pluck('attribute_id')
            ->toArray();
    }

    public function getListProductSameCategory() {
        return Product::with(['Category'])
            ->where('category_id', '=', $this->getAttribute('category_id'))
            ->where('id', '!=', $this->getAttribute('i'))
            ->where('parent_id', '=', null)
            ->get();
    }
}
