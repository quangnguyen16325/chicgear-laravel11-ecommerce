<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'quantity', 'percentage', 'is_active', 'distributed_to_all', 'used_quantity'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_discount')->withPivot('used')->withTimestamps();
    }
}
