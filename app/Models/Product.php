<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'price', 'user_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->user_id = auth()->id();
        });
        // add the global scope here to filter the products based on del_flag
        static::addGlobalScope('del_flag', function (Builder $builder) {
            $builder->where('del_flag', 0);
        });
    }

    /** Relationships */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
