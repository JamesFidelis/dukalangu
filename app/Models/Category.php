<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'shop_id',
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class,'category_id', 'id');
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory::class,'category_id', 'id');
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shops::class,'shop_id', 'id');
    }
}
