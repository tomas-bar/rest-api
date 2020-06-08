<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The categories that product belongs to.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }
}
