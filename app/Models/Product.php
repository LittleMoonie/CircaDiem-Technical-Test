<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'base_price',
        'category_id', // only if One-to-Many approach
    ];

    // One-to-Many approach
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Many-to-Many approach
     public function categories()
     {
         return $this->belongsToMany(Category::class, 'category_product');
     }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Calculate total price with variations.
     * This can be used if you want to sum all variation prices by default.
     */
    public function totalPrice()
    {
        $sumOfVariations = $this->variations->sum('extra_price');
        return $this->base_price + $sumOfVariations;
    }
}
