<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'sale_price',
        'regular_price',
        'quantity',
        'sold_quantity', 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
 