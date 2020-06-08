<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The products that belong to the category.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
}
