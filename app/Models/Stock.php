<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',
        'product_name',
        'owner_id',
        'category_id',
    ];


    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class,'barcode', 'barcode_no');
    }

    public function category(): HasMany
    {
        return $this->hasMany(Category::class,'category_id', 'id');
    }


}
