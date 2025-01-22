<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

//    One-to-Many approach:
//    public function products()
//    {
//        return $this->hasMany(Product::class);
//    }

//   Many-to-Many approach:
     public function products()
     {
         return $this->belongsToMany(Product::class, 'category_product');
     }
}
